<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 17/09/15
 * Time: 15:38
 */

namespace CodeProject\Services;

use CodeProject\Entities\Client;
use CodeProject\Presenters\ClientPresenter;
use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;

class ClientService extends AbstractService
{
    public function __construct(ClientRepository $repository, ClientValidator $validator, ClientPresenter $presenter, Client $entity){
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->presenter  = $presenter;
        $this->entity     = $entity;
    }
}