<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Act.
 *
 * @package namespace App\Entities;
 */
class Act extends Model implements Transformable
{
    use TransformableTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'act';
    protected $fillable = ['act', 'band_id', 'event_id'];

    public function bands(){
        return $this->hasMany('App\Entities\Band', 'band_id');
    }
}
