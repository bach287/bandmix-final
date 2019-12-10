<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Cart.
 *
 * @package namespace App\Entities;
 */
class Cart extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'books';
    protected $fillable = ['name','email','address','number_phone','event_id','member_id','status','ship_form'];
    public function bills()
    {
        return $this->hasOne('App\Entities\Bill','book_id');
    }

}
