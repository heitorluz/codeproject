<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;

class ProjectController extends AbstractController
{
    public function __construct(ProjectService $service){
        $this->service = $service;
    }
}
