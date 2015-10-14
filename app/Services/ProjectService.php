<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 17/09/15
 * Time: 15:38
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Mockery\CountValidator\Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{

    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */
    protected $validator;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator){
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function all(){
        return $this->repository->with(['owner', 'client'])->all();
    }

    public function find($id){

        try{
            return $this->repository->with(['owner', 'client'])->findOrFail($id);
        }catch (Exception $e) {
            return ['message'=>'Registro não localizado.'];
        }
    }

    public function create(array $data){

        try
        {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id){
        return $this->repository->update($data, $id);
    }

    public function delete($id){
        $this->repository->delete($id);
    }
}