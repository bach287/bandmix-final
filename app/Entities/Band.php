<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Band.
 *
 * @package namespace App\Entities;
 */
class Band extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','phone_manager','genre_id','doc','avatar','status','about','location_id','achievements','member_id','slug','number_of_mem'];

    public function member()
    {
        return $this->belongsTo('App\Entities\Member');
    }

    public function genres()
    {
        return $this->belongsTo('App\Entities\Genre','genre_id');
    }
    public function events()
    {
        return $this->belongsToMany('App\Entities\Event');
    }
    public function location()
    {
        return $this->belongsTo('App\Entities\Location');
    }

}
