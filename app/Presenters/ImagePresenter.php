<?php

namespace App\Presenters;

use App\Transformers\ImageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ImagePresenter.
 *
 * @package namespace App\Presenters;
 */
class ImagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ImageTransformer();
    }
}
