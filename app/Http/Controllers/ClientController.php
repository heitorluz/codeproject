<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Services\ClientService;

class ClientController extends AbstractController
{
    public function __construct(ClientService $service){
        $this->service = $service;
    }
}
