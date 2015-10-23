<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 17/09/15
 * Time: 15:38
 */

namespace CodeProject\Services;


use CodeProject\Entities\User;
use CodeProject\Exceptions\ServiceException;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;

class ProjectService extends AbstractService
{

    public function __construct(ProjectRepository $repository, ProjectValidator $validator){
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function all($userId=null){
        return $this->repository->with(['owner', 'client'])->all();
    }

    public function find($id){

        $this->checkProjectPermissions($id);

        try{
            return $this->repository->with(['owner', 'client'])->find($id);
        }catch (\Exception $e) {
            throw new ServiceException("Registro não localizado");
         }
    }

    public function members($id){
        $this->checkProjectPermissions($id);

        try{
            return $this->repository->find($id)->members;
        }catch (\Exception $e) {
            throw new ServiceException("Usuários do projeto não localizados");
        }
    }

    public function update(array $data, $id){
        $this->checkProjectPermissions($id);

        return parent::update($data, $id);
    }

    public function delete($id){
        $this->checkProjectPermissions($id);

        return parent::delete($id);
    }

    public function addMember($id, $memberId){

        $this->checkProjectPermissions($id);

        try{
            $project = $this->repository->find($id);
            $user    = User::find($memberId);

            $project->member()->save($user);

            return ['message'=>'Usuário adicionado ao projeto com sucesso'];
        }catch (\Exception $e) {
            throw new ServiceException("Usuários do projeto não localizados");
        }
    }

    public function removeMember($id, $memberId){

        $this->checkProjectPermissions($id);

        try{
            $project = $this->repository->find($id);
            $user    = User::find($memberId);

            $project->member()->detach($user);

            return ['message'=>'Usuário removido do projeto com sucesso'];
        }catch (\Exception $e) {
            throw new ServiceException("Usuários do projeto não localizados");
        }
    }

    public function isMember($id, $memberId){
        $project = $this->find($id);

        foreach($project->members as $member){
            if($member->id == $memberId){
                return true;
            }
        }

        return false;
    }

    public function isOwner($projectId, $ownerId){

        if (count($this->repository->findWhere(['id'=>$projectId, 'owner_id'=>$ownerId])) > 0){
            return true;
        }

        return false;
    }

    public function hasMember($projectId, $userId){
        $project = $this->repository->find($projectId);

        foreach($project->members as $member){
            if($member->id == $userId){
                return true;
            }
        }

        return false;
    }

    public function checkProjectPermissions($projectId, $userId=null){

        if($userId == null){
            $userId = \Authorizer::getResourceOwnerId();
        }

        if($this->isOwner($projectId, $userId) == true or $this->hasMember($projectId, $userId) == true){
            throw new ServiceException("Access Forbidden");
        }
    }

    public function allUser($userId){
        try{
            return $this->repository->findWhere(['owner_id'=>$userId]);
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage());
        }
    }
}