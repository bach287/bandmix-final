<?php

namespace App\Repositories;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EventRepository;
use App\Entities\Event;
use App\Validators\EventValidator;

/**
 * Class EventRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EventRepositoryEloquent extends BaseRepository implements EventRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Event::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EventValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function queryManage($option = [], $member_id)
    {
        $query = $this->model->query()->where('member_id','=', $member_id);
        if(!empty($option['keyword'])){
            $query->where('name', 'like' , "%" . $option['keyword'].'%');
        }
        if(!empty($option['search_location'])){
            $query->where('location_id',$option['search_location']);
        }
        if(!empty($option['search_date'])){
            $query->where('date',$option['search_date'], date('Y-m-d'));
        }
        return $query;
    }

    public function query($option = [])
    {
        $query = $this->model->query()->where('status','=','1');
        //search for name, id
        if(!empty($option['keyword'])){
            $query->where('id',$option['keyword']);
            $query->orWhere('name', 'like' , "%" . $option['keyword'].'%');
        }

        if(!empty($option['member_id'])){
            $query->where('member_id',$option['member_id']);
        }
        //search for price
        if(!empty($option['search_select'])){
            $query->orderBy('price',$option['search_select']);
        }

        //search for location
        if(!empty($option['search_location'])){

            $query->where('location_id',$option['search_location']);
        }
        return $query;
    }


}
