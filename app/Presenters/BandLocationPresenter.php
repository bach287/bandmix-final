<?php

namespace App\Presenters;

use App\Transformers\BandLocationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BandLocationPresenter.
 *
 * @package namespace App\Presenters;
 */
class BandLocationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BandLocationTransformer();
    }
}
