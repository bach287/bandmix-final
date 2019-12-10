<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Event.
 *
 * @package namespace App\Entities;
 */
class Event extends Model implements Transformable
{
    use Notifiable;
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['description','ticket_also','avatar','name','time','date','member_id','salary','location_id','location_detail','number_phone','mail','vacancy','price','slug','detail','status', 'genre_id'];
    public function locations(){
        return $this->belongsTo('App\Entities\Location','location_id');
    }
    public function genre()
    {
        return $this->belongsTo('App\Entities\Genre');
    }
    public function bands(){
        return $this->belongsToMany('App\Entities\Band','act','event_id','band_id')->withPivot('act');
    }
    public function member()
    {
        return $this->belongsTo('App\Entities\Member');
    }

}
