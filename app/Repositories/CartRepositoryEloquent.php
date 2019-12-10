<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CartRepository;
use App\Entities\Cart;
use App\Validators\CartValidator;

/**
 * Class CartRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CartRepositoryEloquent extends BaseRepository implements CartRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cart::class;
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
            $query->where('id','=' ,$option['keyword']);
            $query->orWhere('name', 'like','%'.$option['keyword'].'%');
        }

        return $query;
    }
}
