<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ActRepository;
use App\Entities\Act;
use App\Validators\ActValidator;

/**
 * Class ActRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ActRepositoryEloquent extends BaseRepository implements ActRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Act::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
