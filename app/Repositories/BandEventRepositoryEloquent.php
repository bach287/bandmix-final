<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BandEventRepository;
use App\Entities\BandEvent;
use App\Validators\BandEventValidator;

/**
 * Class BandEventRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BandEventRepositoryEloquent extends BaseRepository implements BandEventRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BandEvent::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BandEventValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
