<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Exceptions\ServiceException;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectFileController extends AbstractController
{

    public function __construct(ProjectService $service){
        $this->service = $service;
    }

    public function store(Request $request, $id=null){

        $file = $request->file('file');

        if($file == ""){
            return ['error'=>true, 'message'=>"Não foi possível identificar o arquivo."];
        }    

        try {

            $extension = $file->getClientOriginalExtension();

            $name = ($request->name != "") ? $request->name : $file->getClientOriginalName();

            $data['file'] = $file;
            $data['name'] = $name;
            $data['extension'] = $extension;
            $data['project_id'] = $id;

            return $this->service->createFile($data);

        }catch (ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }

    public function destroy($id, Request $request=null){
        return $this->service->deleteFile($id,$request->name);
    }
}
