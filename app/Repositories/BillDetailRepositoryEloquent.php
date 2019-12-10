<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Bill_detailRepository;
use App\Entities\BillDetail;
use App\Validators\BillDetailValidator;

/**
 * Class BillDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BillDetailRepositoryEloquent extends BaseRepository implements BillDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillDetail::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BillDetailValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
