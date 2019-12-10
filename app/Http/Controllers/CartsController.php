<?php

namespace App\Http\Controllers;

use App\Entities\Bill;
use App\Entities\BillDetail;
use App\Repositories\BillDetailRepository;
use App\Repositories\BillRepository;
use App\Repositories\EventRepository;
use App\Repositories\MemberRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CartCreateRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Repositories\CartRepository;
use App\Validators\CartValidator;

/**
 * Class CartsController.
 *
 * @property EventRepository eventRepository
 * @package namespace App\Http\Controllers;
 */
class CartsController extends Controller
{
    /**
     * @var CartRepository
     */
    protected $repository;

    /**
     * @var CartValidator
     */
    protected $validator;
    protected $billRepository;
    protected $billDetailRepository;
    protected $cartRepository;
    protected $memberRepository;

    /**
     * CartsController constructor.
     *
     * @param CartRepository $repository
     * @param CartValidator $validator
     * @param EventRepository $eventRepository
     * @param BillRepository $billRepository
     * @param BillDetailRepository $billDetailRepository
     */
    public function __construct(CartRepository $repository, CartValidator $validator, EventRepository $eventRepository,BillRepository $billRepository,BillDetailRepository $billDetailRepository,CartRepository $cartRepository,MemberRepository $memberRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->eventRepository = $eventRepository;
        $this->billRepository = $billRepository;
        $this->billDetailRepository = $billDetailRepository;
        $this->cartRepository = $cartRepository;
        $this->memberRepository = $memberRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $event = $this->eventRepository->all();
            $book = $this->cartRepository->all();
            $bill = $this->billRepository->all();
            $bill_detail = $this->billDetailRepository->all();
        $this->eventRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $carts = $this->eventRepository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $carts,
            ]);
        }

        return view('cart.show',compact('event','bill','bill_detail','book'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CartCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['member_id'] = Auth::id();
        $data['event_id'] = $request['event_id'];
//        dd($request->all());
        $event = $this->eventRepository->find($data['event_id']);
        $total = $event->price * $data['number_of_ticket'];
        Cart::add(['id' => $data['event_id'], 'name' => $event->name, 'qty' => 1, 'price' => $event->price,
            'options' => [
                'location_detail' => $event->location_detail,
                'avatar' => $event->avatar,
                'number_of_ticket' => $data['number_of_ticket'],
                'total' => $total,
                'member_id' => $data['member_id']
            ]]);;
//        $ticket  = $this->eventRepository->update(['vacancy' => $event->vacancy - $data['number_of_ticket']], $data['event_id']);
//        dd($event->vacancy - $data['number_of_ticket']);
        return redirect()->route('cart.show')->with('success_message', 'Đã thêm thành công vào giỏ hàng');
    }

    public function getCheckout(Request $request)
    {
        try {
            //add to books

            $cartInfo = Cart::content();

//            dd($cartInfo);
            $data = $request->all();
            $data['member_id'] = Auth::id();
            $book =   $this->repository->create($data);


             // add to bills
            $bill = new Bill();
            $bill->book_id = $book->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $data['total_price'];
            $bill->note = $data['note'];
            $bill->save();
            //add to bill_details
            foreach ( $cartInfo  as $key => $value)
            {
                $bill_detail = new BillDetail();
                $bill_detail->book_id = $book->id;
                $bill_detail->bill_id = $bill->id;
                $bill_detail->event_id = $value->id;
                $bill_detail->number_of_ticket = $value->options->number_of_ticket;
//                dd( $value->options->number_of_ticket);
                $bill_detail->price = $value->price;
                $bill_detail->save();

                $event_id = $value->id;
                $event = $this->eventRepository->find($event_id);

              $this->eventRepository->update(['ticket_also' => $event->ticket_also - $value->options->number_of_ticket],$event_id);
//              dd( $event->vacancy -  $value->options->number_of_ticket);

            }
            Cart::destroy();
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
        return redirect(route('members.manageBill', $data['member_id'] = Auth::id()))->with('success_message', 'Mua hàng thành công');
    }

    public function buySuccess(Request $request)
    {
        $book = $request->all();

    }

    public function empty()
    {

        Cart::destroy();
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
        $cart = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cart,
            ]);
        }

        return view('carts.show', compact('cart'));
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
        $cart = $this->repository->find($id);

        return view('carts.edit', compact('cart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CartUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CartUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cart = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Cart updated.',
                'data' => $cart->toArray(),
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect()->back()->with('message', 'Cart deleted.');
    }
}
