<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 14/10/15
 * Time: 15:33
 */

namespace CodeProject\Services;

use CodeProject\Entities\AbstractEntity;
use CodeProject\Exceptions\ServiceException;
use CodeProject\Transformers\AbstractTransformer;
use CodeProject\Transformers\ProjectTransformer;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Validator\Exceptions\ValidatorException;

class AbstractService
{
    protected $repository;
    protected $validator;
    protected $transformer;
    protected $entity;

    public function all(){
        try {
            return $this->transformer->transformCollection($this->repository->all());
        }catch (\Exception $e){
            throw new ServiceException("Não foi possível carregar os dados");
        }
    }

    public function find($id){
        try{
            return $this->transformer->transformObject($this->repository->find($id));
        }catch (\Exception $e) {
            throw new ServiceException("Registro não localizado");
        }
    }

    public function create(array $data){

        try
        {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }catch (ValidatorException $e){
            throw new ServiceException($e->getMessageBag());
        }
    }

    public function update(array $data, $id){

        try
        {
            return $this->repository->update($data, $id);
        }catch (ValidatorException $e) {
            throw new ServiceException($e->getMessageBag());
        }catch (\Exception $e) {
            throw new ServiceException("Houve um erro na alteração do registro");
        }
    }

    public function delete($id){
        try {
            $this->repository->delete($id);
            return ['message'=>'Registro excluído com sucesso'];
        }catch (\Exception $e){
            throw new ServiceException("Houve um erro na deleção do registro");
        }
    }
}