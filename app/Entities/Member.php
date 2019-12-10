<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;


/**
 * Class Member.
 *
 * @package namespace App\Entities;
 */
class Member extends Model implements Transformable
{
    use Notifiable;
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','password','dob','phone_number','address','gender','avatar','status'];
    public function events(){
        return $this->belongsToMany('\App\Entities\Event','books','member_id','event_id');
    }
}
