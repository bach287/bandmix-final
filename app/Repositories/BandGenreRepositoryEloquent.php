<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BandGenreRepository;
use App\Entities\BandGenre;
use App\Validators\BandGenreValidator;

/**
 * Class BandGenreRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BandGenreRepositoryEloquent extends BaseRepository implements BandGenreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BandGenre::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BandGenreValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
