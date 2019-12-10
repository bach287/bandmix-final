<?php

namespace App\Presenters;

use App\Transformers\BandTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BandPresenter.
 *
 * @package namespace App\Presenters;
 */
class BandPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BandTransformer();
    }
}
