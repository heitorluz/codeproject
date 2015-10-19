<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 17/09/15
 * Time: 15:38
 */

namespace CodeProject\Services;


use CodeProject\Exceptions\ServiceException;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;

class ProjectNoteService extends AbstractService
{

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator){
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function all($projectId=null){
        try{
            return $this->repository->findWhere(['project_id'=>$projectId]);
        }catch (\Exception $e) {
            throw new ServiceException("Registro não localizado");
        }
    }

    public function find($project_id=null,$id=null){
        try{
            $note = $this->repository->find($id);
        }catch (\Exception $e) {
            throw new ServiceException("Registro não localizado");
        }

        if($note->project->id != $project_id){
            throw new ServiceException("A anotação pedida não faz parte do projeto");
        }

        return $note;
    }

    public function create(array $data, $projectId=null){
        if(isset($data['project_id'])){
            if($data['project_id'] != $projectId){
                throw new ServiceException("O project_id informado não pode ser diferente do project_id informado na url");
            }
        }else{
            $data['project_id'] = $projectId;
        }

        return parent::create($data);
    }

    public function update(array $data,$projectId=null,$id=null){
        if(isset($data['project_id'])){
            if($data['project_id'] != $projectId){
                throw new ServiceException("O project_id informado não pode ser diferente do project_id informado na url");
            }
        }else{
            $data['project_id'] = $projectId;
        }

        return parent::update($data,$id);
    }
}