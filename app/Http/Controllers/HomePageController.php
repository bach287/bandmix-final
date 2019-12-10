<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NewsRepository;
use App\Http\Controllers\Controller;
use App\Entities\News;
use App\Entities\Band;
use App\Entities\Event;

class HomePageController extends Controller
{
/**
 * @var NewsRepository
 */
protected $newsRepository;
protected $eventRepository;

/**
 * EventsController constructor.
 * @param NewsRepository $repository
 */

public function __construct(NewsRepository $newsRepository, EventRepository $eventRepository)
{
    $this->newsRepository = $newsRepository;
    $this->eventRepository = $eventRepository;
}

    public function index() {
        // $news = $this->newsRepository->findWhere([
        //     'is_show_home'=> 1,
        // ]);

        $news = News::query()->where('status','=','1')->orderBy('created_at', 'desc')->paginate('4');

        $bands = Band::query()->where('status','=','1')->orderBy('created_at', 'desc')->paginate('4');

        $events = Event::query()->where('status','=','1')->orderBy('date', 'desc')->paginate(3);

        $data['news'] = $news;
        $data['bands'] = $bands;
        $data['events'] = $events;
        $this->checkDateEvent();
        return view('welcome', $data);
    }

    public function search(Request $request) {
        $news = News::query()->where('status','=','1')->where('title', 'like', '%' . $request->searchValue . '%')->paginate('4');

        $bands = Band::query()->where('status','=','1')->where('name', 'like', '%' . $request->searchValue . '%')->paginate('4');

        $events = Event::query()->where('status','=','1')->where('name', 'like', '%' . $request->searchValue . '%')->paginate(3);

        $data['news'] = $news;
        $data['bands'] = $bands;
        $data['events'] = $events;

        return view('welcome', $data);
    }

    public function checkDateEvent()
    {
        Event::query()->where('date' ,'<' , date('Y-m-d'))->update(['status' => '0']);
    }
}
