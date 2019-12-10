<?php

namespace App\Presenters;

use App\Transformers\EventGenreTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EventGenrePresenter.
 *
 * @package namespace App\Presenters;
 */
class EventGenrePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EventGenreTransformer();
    }
}
