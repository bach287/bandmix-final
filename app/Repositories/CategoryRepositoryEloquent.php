<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoryRepository;
use App\Entities\Category;
use App\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CategoryValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
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
