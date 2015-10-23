<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:27
 */

namespace CodeProject\Presenters;


use CodeProject\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter
{
    public function getTransformer(){
        return new ProjectTransformer();
    }
}