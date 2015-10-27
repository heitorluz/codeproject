<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 17/09/15
 * Time: 15:38
 */

namespace CodeProject\Services;


use CodeProject\Entities\Project;
use CodeProject\Entities\ProjectFile;
use CodeProject\Entities\User;
use CodeProject\Exceptions\ServiceException;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Transformers\ProjectMemberTransformer;
use CodeProject\Transformers\ProjectTransformer;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectService extends AbstractService
{

    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    public function __construct(
        ProjectRepository $repository,
        ProjectValidator $validator,
        Filesystem $filesystem,
        Storage $storage,
        ProjectTransformer $transformer,
        Project $entity
    ){
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->transformer = $transformer;
        $this->entity = $entity;
    }

    public function all(){
        $userId = \Authorizer::getResourceOwnerId();

        try{
            return $this->transformer->transformCollection($this->repository->findWhere(['owner_id'=>$userId]));
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage());
        }
    }

    public function find($id){
        $this->checkProjectPermissions($id);
        return parent::find($id);
    }

    public function members($id){
        $this->checkProjectPermissions($id);

        $projectMemberTransformer = new ProjectMemberTransformer();

        try{
            return $projectMemberTransformer->transformCollection($this->repository->find($id)->members);
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

        if($this->isOwner($projectId, $userId) == false and $this->hasMember($projectId, $userId) == false){
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

    public function createFile(array $data){

        try {
            $project = $this->repository->find($data['project_id']);
            $project->files()->create($data);
        }catch (\Exception $e){
            throw new ServiceException('Não foi possível gravar o arquivo no banco de dados.');
        }

        try{
            $this->storage->put($data['name'] . "." . $data['extension'], $this->filesystem->get($data['file']));

            return ['message'=>'File upload successfully'];
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage());
        }
    }

    public function deleteFile($id,$name){
        try {
            $project = $this->repository->find($id);
            foreach($project->files as $file){
                if($file->name == $name){
                    $file->delete();
                }
            }
        }catch (\Exception $e){
            throw new ServiceException('Não foi possível gravar o arquivo no banco de dados.');
        }

        try{
            $this->storage->delete($name);

            return ['message'=>'File delete successfully'];
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage());
        }

    }
}