<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\newsRepository;
use App\Entities\News;
use App\Validators\NewsValidator;

/**
 * Class NewsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NewsRepositoryEloquent extends BaseRepository implements NewsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return News::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return NewsValidator::class;
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
        $query = $this->model->query();
        //search for name, id
        if(!empty($option['keyword'])){
            $query->where('id',$option['keyword']);
            $query->orWhere('title', $option['keyword']);
        }
        return $query;

    }
}
