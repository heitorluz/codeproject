<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Exceptions\ServiceException;
use CodeProject\Services\ProjectNoteService;

use CodeProject\Http\Requests;
use Illuminate\Http\Request;

class ProjectNoteController extends AbstractController
{
    public function __construct(ProjectNoteService $service){
        $this->service = $service;
    }

    public function index($projectId=null){
        try {
            return $this->service->all($projectId);
        }catch (ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }

    public function show($projectId=null,$id=null){
        try {
            return $this->service->find($projectId, $id);
        }catch (ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }

    public function store(Request $request, $projectId=null){
        try {
            return $this->service->create($request->all(), $projectId);
        }catch (ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }

    public function update(Request $request, $projectId=null, $id=null){
        try {
            return $this->service->update($request->all(), $projectId, $id);
        }catch (ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }

    public function destroy($projectId=null,$id=null){
        return parent::destroy($id);
    }
}
