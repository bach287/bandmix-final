<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Genre.
 *
 * @package namespace App\Entities;
 */
class Genre extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name'];

    public function bands()
    {
        return $this->hasMany('App\Entities\Band');
    }
    public function events()
    {
        return $this->hasOne('App\Entities\Event');
    }


}
