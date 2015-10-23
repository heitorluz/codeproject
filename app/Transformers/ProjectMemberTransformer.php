<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:21
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;


class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform(User $member){
        return [
            'nome' => $member->name,
        ];
    }
}