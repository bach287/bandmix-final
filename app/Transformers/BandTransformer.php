<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Band;

/**
 * Class BandTransformer.
 *
 * @package namespace App\Transformers;
 */
class BandTransformer extends TransformerAbstract
{
    /**
     * Transform the Band entity.
     *
     * @param \App\Entities\Band $model
     *
     * @return array
     */
    public function transform(Band $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
