<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:21
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\User;

class ProjectMemberTransformer extends AbstractTransformer
{
    public function transform(User $member){
        return [
            'id'          => $member->id,
            'name'        => $member->name,
            'responsible' => $member->responsible,
            'email'       => $member->email,
            'phone'       => $member->phone,
            'address'     => $member->address,
            'obs'         => $member->obs,
        ];
    }
}