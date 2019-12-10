<?php

namespace App\Presenters;

use App\Transformers\BillDetailTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BillDetailPresenter.
 *
 * @package namespace App\Presenters;
 */
class BillDetailPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BillDetailTransformer();
    }
}
