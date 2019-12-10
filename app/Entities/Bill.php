<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Bill.
 *
 * @package namespace App\Entities;
 */
class Bill extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='bills';
    protected $fillable = ['book_id','date_order','total','note','number_of_ticket'];
    public function book()
    {
        return $this->belongsTo('App\Entities\Cart');
    }
    public function bill_details()
    {
        return $this->hasMany('App\Entities\BillDetail');
    }


}
