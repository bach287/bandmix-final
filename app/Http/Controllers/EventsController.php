<?php

namespace App\Http\Controllers;

use App\Entities\Band;
use App\Entities\Genre;
use App\Entities\Event;
use App\Entities\EventGenre;
use App\Entities\Act;

use App\Notifications\InvoicePaid;
use App\Repositories\MemberRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\BandConfirm;

use App\Repositories\BandRepository;
use App\Repositories\EventGenreRepository;
use App\Repositories\GenreRepository;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Repositories\EventRepository;
use App\Validators\EventValidator;


/**
 * Class EventsController.
 *
 * @property LocationRepository locationRespository
 * @package namespace App\Http\Controllers;
 */
class EventsController extends Controller
{
    /**
     * @var EventRepository
     */
    protected $repository;

    /**
     * @var EventValidator
     */
    protected $validator;
    protected $bandRespository;
    protected $eventHost;
    protected $memberRepository;

    /**
     * EventsController constructor.
     *
     * @param EventRepository $repository
     * @param EventValidator $validator
     */

    /**
     * EventsController constructor.
     * @param EventRepository $repository
     * @param EventValidator $validator
     * @param LocationRepository $locationRepository
     *  @param BandRepository $bandRepository
     */

    public function __construct(MemberRepository $memberRepository, EventRepository $repository, EventValidator $validator, LocationRepository $locationRepository, BandRepository $bandRepository, Event $eventHost)
    {

        $this->repository = $repository;
        $this->validator  = $validator;
        $this->locationRespository = $locationRepository;
        $this->bandRespository = $bandRepository;
        $this->eventHost = $eventHost;
        $this->memberRepository = $memberRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $locations = $this->locationRespository->all();
        $events_search = $this->repository->query($request->all())->latest()->paginate(12);
        $events = Event::query()->where('status','=','1')->orderBy('date', 'desc')->paginate(3);
        return view('events.index', compact('events','events_search','locations'));
    }

    public function create(Request $request)
    {
        $bands = Band::all();
        $genres = Genre::all();
        $locations = $this->locationRespository->all();
        return view('events.create',compact('genres','bands','locations'))  ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EventCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EventCreateRequest $request)
    {
        $data = $request->all();
        if(empty($data['event_id'])) {
            $data['member_id'] = Auth::id();
            $data['status'] = '2';
            $data['ticket_also'] = $data['vacancy'];
            $data['slug'] = str_slug($data['name'], '-');
            if($request->hasFile('avatar')){
                $data['avatar'] = 'http://dev.bandmix.com/' .$this->uploadFile($request['avatar']);
            }else{
                $data['avatar'] = 'uploads/avatar/default.jpg';
            }
            $event = $this->repository->create($data);
            if(count($data['item_name']) > 1) {
                $event_id = $event->id;
                $total_item = count($data['item_name']);
                for($i = 1; $i < $total_item; $i++) {
                    $data_act[] = [
                        'act' => $data['item_name'][$i],
                        'band_id' => $data['band'][$i],
                        'event_id' => $event_id
                    ];
                    $band = $this->bandRespository->find($data['band'][$i]);
                    $member = $this->memberRepository->find($band->member_id);
                    $member->notify(new InvoicePaid($band, $event));

                    // Mail::to($band->email)->send(new BandConfirm($event->name));
                } 
                Act::insert($data_act);
            }
        } else {
            if($request->hasFile('avatar')){
                $data['avatar'] ='http://dev.bandmix.com/'. $this->uploadFile($request['avatar']);
            }
            $event = $this->repository->update($data, $data['event_id']);
//            Act::where('event_id', $data['event_id'])->delete();
//            dd(count($data['item_name']));
            if(count($data['item_name']) > 1) {
                $event_id = $event->id;
                $total_item = count($data['item_name']);
                for($i = 1; $i < $total_item; $i++) {
                    $data_act[] = [
                        'act' => $data['item_name'][$i],
                        'band_id' => $data['band'][$i],
                        'event_id' => $event_id
                    ];
                    $band = $this->bandRespository->find($data['band'][$i]);
                    $member = $this->memberRepository->find($band->member_id);
                    $member->notify(new InvoicePaid($band, $event));
                }
//                dd($data_act);
                Act::insert($data_act);
            }
        }
        $locations = $this->locationRespository->all();
        $events_search = $this->repository->query($request->all())->latest()->paginate(12);
        $events = $this->repository->findWhere([
            'is_on_top' => 1
        ]);
        return redirect(route('events.manage',compact('events','events_search','locations')) );
    }

    public function contact($id){
        $event = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $event,
            ]);
        }
        return view('events.contact', compact('event'));
    }
    public function manage(Request $request){
        $locations = $this->locationRespository->all();
        $member_id = Auth::id();
        $genre = Genre::all();
        $events = $this->repository->queryManage($request->all(), $member_id)->paginate(12);
        return view('events.manage',compact('events','locations','genre'));
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
        $event = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $event,
            ]);
        }

        return view('events.show', compact('event'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function review($id)
    {
        $event = $this->repository->find($id);
        $acts = Act::where('event_id', $id)->get();
        $bands = Band::all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $event,
            ]);
        }
        return view('events.review', compact('event','acts','bands'));
    }

    public function confirm(EventUpdateRequest $request)
    {
        $data = $request->all();
        $event = $this->repository->find($data['event_id']);
        if(count($data['item_name']) > 1) {
            $total_item = count($data['item_name']);
            for ($i = 1; $i < $total_item; $i++) {
                $data_act[] = [
                    'act' => $data['item_name'][$i],
                    'band_id' => $data['band'][$i],
                    'event_id' => $request['event_id'],
                ];
                $band = $this->bandRespository->find($data['band'][$i]);
                $member = $this->memberRepository->find($band->member_id);
                $member->notify(new InvoicePaid($band, $event));
            }
            Act::insert($data_act);
        }
        $this->repository->update($request->only('status') , $request['event_id']);
        $member_id = Auth::id();
        $events = $this->repository->findWhere(['member_id' => $member_id]);
        $locations = $this->locationRespository->all();

        return redirect(route('events.manage',compact('events','locations')));
    }
    public function edit($id)
    {
        $locations = $this->locationRespository->all();
        $bands = Band::all();
        $genres = Genre::all();
        $event = $this->repository->find($id);
        $acts = Act::where('event_id', $id)->get();
        return view('events.edit', compact('event', 'bands', 'genres', 'acts','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EventUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EventUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $event = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'Event updated.',
                'data'    => $event->toArray(),
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
//     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Event deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect('/event/manage')->with('message', 'Event deleted.');
    }


    public function search($option = []){

    }

    public function deleteEvent($id) {
        $deleted = $this->repository->delete($id);
        return redirect('/event/manage');
    }

}
