<?php

namespace App\Http\Controllers;

use App\Entities\Band;
use App\Entities\Genre;
use App\Repositories\BandGenreRepository;
use App\Repositories\GenreRepository;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BandCreateRequest;
use App\Http\Requests\BandUpdateRequest;
use App\Repositories\BandRepository;
use App\Validators\BandValidator;
use App\Entities\Location;
use Illuminate\Support\Facades\Auth;

/**
 * Class BandsController.
 *
 * @property LocationRepository locationRepository
 * @package namespace App\Http\Controllers;
 */
class BandsController extends Controller
{
    /**
     * @var BandRepository
     */
    protected $repository;

    /**
     * @var BandValidator
     */
    protected $validator;
    protected $locationRepository;

    /**
     * BandsController constructor.
     *
     * @param BandRepository $repository
     * @param BandValidator $validator
     * @param LocationRepository $locationRepository
     */
    public function __construct(BandRepository $repository, BandValidator $validator,LocationRepository $locationRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->locationRepository = $locationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bands = $this->repository->query($request->all())->paginate(12);
        $new_bands = Band::query()->latest()->paginate(4);
        $locations = $this->locationRepository->all();
        $genres = Genre::all();
        return view('bands.index', compact('bands','genres','locations','new_bands'));
    }

    public function create()
    {
        $locations = Location::all();
        $genres = Genre::all();
        return view('bands.create',compact('locations','genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BandCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BandCreateRequest $request) {
        try {

            $data = $request->all();
            $data['member_id'] = Auth::id();
            //file upload handle
            if ($request->hasFile('avatar')){
                $data['avatar'] = 'http://dev.bandmix.com/'. $this->uploadFile($request['avatar']);
            }else{
                $data['avatar'] = 'images/uploads/default.jpg';
            }
            $band = $this->repository->create($data);
            $request['slug'] = str_slug($band->name, '-') . '-n'.$band->id;
            $this->repository->update($request->only('slug'),$band->id);
            $slug = $request['slug'];
//            dd($band);
            return redirect()->route('bands.show',$slug);
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

    public function management(Request $request){
        $member_id = Auth::id();
        $genres = Genre::all();
        $locations = $this->locationRepository->all();
        $bands = $this->repository->queryManage($request, $member_id)->get();
        return view('bands.manager',compact('bands','locations','genres'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $band_collection = $this->repository->findWhere(['slug' => $slug]);
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $band_collection,
            ]);
        }

        $band = $band_collection[0];
        return view('bands.show', compact('band'));
    }

    public function contact($id){
        $band = $this->repository->find($id);

        return view('bands.contact',compact('band'));
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
        $locations = Location::all();
        $genres = Genre::all();
        $band = $this->repository->find($id);
        return view('bands.edit', compact('band','locations','genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BandUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BandUpdateRequest $request, $id)
    {
        try {
            $data = $request->all();
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            if ($request->hasFile('avatar')){
                $data['avatar'] = 'http://dev.bandmix.com/' .$this->uploadFile($request['avatar']);
            }
            $band = $this->repository->update($data, $id);

            $response = [
                'message' => 'Band updated.',
                'data'    => $band->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect(route('bands.show',$band->slug))->with('message', $response['message']);
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
//    public function destroy($id)
//    {
////        dd($id);
//        $deleted = $this->repository->delete($id);
//
//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'message' => 'Band deleted.',
//                'deleted' => $deleted,
//            ]);
//        }
//
//        return redirect()->back()->with('message', 'Band deleted.');
//    }
    public function deleteBand($id) {
        $deleted = $this->repository->delete($id);
        return redirect()->back();
    }
}
