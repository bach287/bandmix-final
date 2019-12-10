<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\BillDetail;

/**
 * Class BillDetailTransformer.
 *
 * @package namespace App\Transformers;
 */
class BillDetailTransformer extends TransformerAbstract
{
    /**
     * Transform the BillDetail entity.
     *
     * @param \App\Entities\BillDetail $model
     *
     * @return array
     */
    public function transform(BillDetail $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
