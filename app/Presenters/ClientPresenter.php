<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:27
 */

namespace CodeProject\Presenters;


use CodeProject\Transformers\ClientTransformer;

class ClientPresenter extends AbstractPresenter
{
    public function getTransformer(){
        return new ClientTransformer();
    }
}