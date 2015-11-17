<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 26/10/15
 * Time: 15:46
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\AbstractEntity;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;

class AbstractTransformer extends TransformerAbstract
{
    public function transformObject(AbstractEntity $entity){
        return $this->transform($entity);
    }

    public function transformCollection(Collection $collection){
        $result = array();

        foreach($collection as $entity){
            $result[] = $this->transformObject($entity);
        }

        return $result;
    }
}