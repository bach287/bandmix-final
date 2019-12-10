<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Location;

/**
 * Class LocationTransformer.
 *
 * @package namespace App\Transformers;
 */
class LocationTransformer extends TransformerAbstract
{
    /**
     * Transform the Location entity.
     *
     * @param \App\Entities\Location $model
     *
     * @return array
     */
    public function transform(Location $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
