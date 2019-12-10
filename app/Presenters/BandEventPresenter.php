<?php

namespace App\Presenters;

use App\Transformers\BandEventTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BandEventPresenter.
 *
 * @package namespace App\Presenters;
 */
class BandEventPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BandEventTransformer();
    }
}
