<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\BandGenre;

/**
 * Class BandGenreTransformer.
 *
 * @package namespace App\Transformers;
 */
class BandGenreTransformer extends TransformerAbstract
{
    /**
     * Transform the BandGenre entity.
     *
     * @param \App\Entities\BandGenre $model
     *
     * @return array
     */
    public function transform(BandGenre $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
