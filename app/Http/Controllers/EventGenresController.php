<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EventGenreCreateRequest;
use App\Http\Requests\EventGenreUpdateRequest;
use App\Repositories\EventGenreRepository;
use App\Validators\EventGenreValidator;

/**
 * Class EventGenresController.
 *
 * @package namespace App\Http\Controllers;
 */
class EventGenresController extends Controller
{
    /**
     * @var EventGenreRepository
     */
    protected $repository;

    /**
     * @var EventGenreValidator
     */
    protected $validator;

    /**
     * EventGenresController constructor.
     *
     * @param EventGenreRepository $repository
     * @param EventGenreValidator $validator
     */
    public function __construct(EventGenreRepository $repository, EventGenreValidator $validator)
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
        $eventGenres = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $eventGenres,
            ]);
        }

        return view('eventGenres.index', compact('eventGenres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EventGenreCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EventGenreCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $eventGenre = $this->repository->create($request->all());

            $response = [
                'message' => 'EventGenre created.',
                'data'    => $eventGenre->toArray(),
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
        $eventGenre = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $eventGenre,
            ]);
        }

        return view('eventGenres.show', compact('eventGenre'));
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
        $eventGenre = $this->repository->find($id);

        return view('eventGenres.edit', compact('eventGenre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EventGenreUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EventGenreUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $eventGenre = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'EventGenre updated.',
                'data'    => $eventGenre->toArray(),
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
                'message' => 'EventGenre deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'EventGenre deleted.');
    }
}
