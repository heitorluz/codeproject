<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Exceptions\ServiceException;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;

class ProjectController extends AbstractController
{
    public function __construct(ProjectService $service){
        $this->service = $service;
    }

    public function members($id){
        try{
            return $this->service->members($id);
        }catch (ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }
}
