<?php

namespace App\Presenters;

use App\Transformers\BandGenreTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BandGenrePresenter.
 *
 * @package namespace App\Presenters;
 */
class BandGenrePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BandGenreTransformer();
    }
}
