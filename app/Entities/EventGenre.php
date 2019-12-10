<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EventGenre.
 *
 * @package namespace App\Entities;
 */
class EventGenre extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'event_genre';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_id', 'genre_id'];

}
