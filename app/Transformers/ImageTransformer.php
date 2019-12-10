<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Image;

/**
 * Class ImageTransformer.
 *
 * @package namespace App\Transformers;
 */
class ImageTransformer extends TransformerAbstract
{
    /**
     * Transform the Image entity.
     *
     * @param \App\Entities\Image $model
     *
     * @return array
     */
    public function transform(Image $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
