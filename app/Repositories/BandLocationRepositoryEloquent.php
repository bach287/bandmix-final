<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BandLocationRepository;
use App\Entities\BandLocation;
use App\Validators\BandLocationValidator;

/**
 * Class BandLocationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BandLocationRepositoryEloquent extends BaseRepository implements BandLocationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BandLocation::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BandLocationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
