<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 17/09/15
 * Time: 15:38
 */

namespace CodeProject\Services;


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
}