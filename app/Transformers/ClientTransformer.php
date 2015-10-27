<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:21
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\Client;

class ClientTransformer extends AbstractTransformer
{
    public function transform(Client $client){
        return [
            'id'          => $client->id,
            'name'        => $client->name,
            'responsible' => $client->responsible,
            'email'       => $client->email,
            'phone'       => $client->phone,
            'address'     => $client->address,
            'obs'         => $client->obs,
        ];
    }
}