<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BandEventCreateRequest;
use App\Http\Requests\BandEventUpdateRequest;
use App\Repositories\BandEventRepository;
use App\Validators\BandEventValidator;

/**
 * Class BandEventsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BandEventsController extends Controller
{
    /**
     * @var BandEventRepository
     */
    protected $repository;

    /**
     * @var BandEventValidator
     */
    protected $validator;

    /**
     * BandEventsController constructor.
     *
     * @param BandEventRepository $repository
     * @param BandEventValidator $validator
     */
    public function __construct(BandEventRepository $repository, BandEventValidator $validator)
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
        $bandEvents = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bandEvents,
            ]);
        }

        return view('bandEvents.index', compact('bandEvents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BandEventCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BandEventCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bandEvent = $this->repository->create($request->all());

            $response = [
                'message' => 'BandEvent created.',
                'data'    => $bandEvent->toArray(),
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
        $bandEvent = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bandEvent,
            ]);
        }

        return view('bandEvents.show', compact('bandEvent'));
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
        $bandEvent = $this->repository->find($id);

        return view('bandEvents.edit', compact('bandEvent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BandEventUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BandEventUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bandEvent = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BandEvent updated.',
                'data'    => $bandEvent->toArray(),
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
                'message' => 'BandEvent deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BandEvent deleted.');
    }
}
