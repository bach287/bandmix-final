<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BillDetailCreateRequest;
use App\Http\Requests\BillDetailUpdateRequest;
use App\Repositories\BillDetailRepository;
use App\Validators\BillDetailValidator;

/**
 * Class BillDetailsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BillDetailsController extends Controller
{
    /**
     * @var BillDetailRepository
     */
    protected $repository;

    /**
     * @var BillDetailValidator
     */
    protected $validator;

    /**
     * BillDetailsController constructor.
     *
     * @param BillDetailRepository $repository
     * @param BillDetailValidator $validator
     */
    public function __construct(BillDetailRepository $repository, BillDetailValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $billDetails = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $billDetails,
            ]);
        }

        return view('billDetails.index', compact('billDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BillDetailCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BillDetailCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $billDetail = $this->repository->create($request->all());

            $response = [
                'message' => 'BillDetail created.',
                'data'    => $billDetail->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $billDetail = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $billDetail,
            ]);
        }

        return view('billDetails.show', compact('billDetail'));
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
        $billDetail = $this->repository->find($id);

        return view('billDetails.edit', compact('billDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BillDetailUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BillDetailUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $billDetail = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BillDetail updated.',
                'data'    => $billDetail->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
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
                'message' => 'BillDetail deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BillDetail deleted.');
    }
}
