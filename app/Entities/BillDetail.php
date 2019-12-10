<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BillDetail.
 *
 * @package namespace App\Entities;
 */
class BillDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'bill_details';
    protected $fillable = ['bill_id','event_id','number_of_ticket','price'];
    public function bill()
    {
        return $this->belongsTo('App\Entities\Bill');
    }

}
