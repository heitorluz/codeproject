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

    public function all(){
        return $this->repository->with(['owner', 'client'])->all();
    }

    public function find($id){
        try{
            return $this->repository->with(['owner', 'client'])->find($id);
        }catch (\Exception $e) {
            throw new ServiceException("Registro não localizado");
         }
    }

    public function members($id){
        try{
            return $this->repository->find($id)->members;
        }catch (\Exception $e) {
            throw new ServiceException("Usuários do projeto não localizados");
        }
    }

    public function addMember($id, $memberId){
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
}