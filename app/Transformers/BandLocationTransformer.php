<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\BandLocation;

/**
 * Class BandLocationTransformer.
 *
 * @package namespace App\Transformers;
 */
class BandLocationTransformer extends TransformerAbstract
{
    /**
     * Transform the BandLocation entity.
     *
     * @param \App\Entities\BandLocation $model
     *
     * @return array
     */
    public function transform(BandLocation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
