<?php

namespace App\Http\Controllers;

use App\Entities\Bill;
use App\Repositories\BillDetailRepository;
use App\Repositories\BillRepository;
use App\Repositories\CartRepository;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MemberCreateRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Repositories\MemberRepository;
use App\Validators\MemberValidator;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\collection;

/**
 * Class MembersController.
 *
 * @package namespace App\Http\Controllers;
 */
class MembersController extends Controller
{
    /**
     * @var MemberRepository
     */
    protected $repository;

    /**
     * @var MemberValidator
     */
    protected $validator;
    protected $cartRepository;
    protected $billRepository;
    protected $billDetailRepository;
    protected $eventRepository;


    /**
     * MembersController constructor.
     *
     * @param MemberRepository $repository
     * @param MemberValidator $validator
     * @param CartRepository $cartRepository
     * @param BillRepository $billRepository
     * @param BillDetailRepository $billDetailRepository
     */


    public function __construct(MemberRepository $repository, MemberValidator $validator, CartRepository $cartRepository,
                                BillRepository $billRepository, BillDetailRepository $billDetailRepository, EventRepository $eventRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->cartRepository = $cartRepository;
        $this->billRepository = $billRepository;
        $this->billDetailRepository = $billDetailRepository;
        $this->eventRepository = $eventRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $member = $this->repository->findWhere(['id'=>$id]);
//        return view('members.index', compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MemberCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MemberCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $member = $this->repository->create($request->all());
            $request['slug'] = str_slug($member->name, '-') . '-n' . $member->id;
            $this->repository->update($request->only('slug'), $member->id);
            $response = [
                'message' => 'Member created.',
                'data' => $member->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function notiView($id)
    {
        $member = $this->repository->find($id);
        return view('members.notifications', compact('member'));
    }


    public function manage()
    {
        $member_id = Auth::id();
        $cart = $this->cartRepository->findWhere(['member_id' => $member_id]);
        return view('member.manage', compact('cart'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = $this->repository->find($id);
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $member,
            ]);
        }

        return view('members.index', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = $this->repository->find($id);

        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MemberUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MemberUpdateRequest $request, $id)
    {
        try {
            $data = $request->all();
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            if ($request->hasFile('avatar')){
                $data['avatar'] = $this->uploadFile($request['avatar']);
            }else{
                $data['avatar'] = 'images/uploads/default.jpg';
            }
//            dd($request->hasFile('avatar'));

            $member = $this->repository->update($data, $id);

            $response = [
                'message' => 'Member updated.',
                'data'    => $member->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('members.index', $member->id)->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Member deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Member deleted.');
    }

    public function getData()
    {
        $member_id = Auth::id();
        $books = $this->cartRepository->findWhere(['member_id' => $member_id]);

        return DataTables::of($books)
            ->addColumn('status', function ($item) {
                $status = $item->status;
                return view('partials.label', compact('status'));
            })
            ->addColumn('price', function ($item) {
                $price = number_format($item->price);
                return view('partials.label', compact('price'));
            })
            ->addColumn('ship_form', function ($item) {

                $ship_form = $item->ship_form;
                return view('partials.ship_form', compact('ship_form'));
            })
            ->addColumn('total', function ($item) {
//                dd($item->bills);
                $total = $item->bills->total;
                return $total;
            })
            ->rawColumns(['status', 'ship_form','price'])
            ->make(true);
    }

    public function manageBill($id)
    {
        $member = $this->repository->find($id);
        return view('members.manage', compact('member'));
    }

    public function getDataBook()
    {
        $member_id = Auth::id();
        $event = $this->eventRepository->findWhere(['member_id' => $member_id]);
        return DataTables::of($event)

            ->make(true);
    }

    public function manageBooks($id)
    {

        $member = $this->repository->find($id);
        $event = $this->eventRepository->findWhere(['member_id' => $member->id]);
        return view('members.manageBook', compact('member', 'event'));
    }

}
