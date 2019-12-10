<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\EventGenre;

/**
 * Class EventGenreTransformer.
 *
 * @package namespace App\Transformers;
 */
class EventGenreTransformer extends TransformerAbstract
{
    /**
     * Transform the EventGenre entity.
     *
     * @param \App\Entities\EventGenre $model
     *
     * @return array
     */
    public function transform(EventGenre $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
