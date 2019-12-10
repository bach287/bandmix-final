<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EventGenreRepository;
use App\Entities\EventGenre;
use App\Validators\EventGenreValidator;

/**
 * Class EventGenreRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EventGenreRepositoryEloquent extends BaseRepository implements EventGenreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventGenre::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EventGenreValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
