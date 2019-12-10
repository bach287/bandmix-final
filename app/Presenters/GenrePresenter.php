<?php

namespace App\Presenters;

use App\Transformers\GenreTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GenrePresenter.
 *
 * @package namespace App\Presenters;
 */
class GenrePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GenreTransformer();
    }
}
