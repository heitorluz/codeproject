<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 17/09/15
 * Time: 15:38
 */

namespace CodeProject\Services;


use CodeProject\Exceptions\ServiceException;
use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{

    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator){
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function all(){
        return $this->repository->all();
    }

    public function find($id){
        try{
            return $this->repository->find($id);
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
            throw new ServiceException($e->getMessage());
        }
    }

    public function delete($id){
        try {
            $this->repository->delete($id);
            return ['message'=>'Registro excluído com sucesso'];
        }catch (\Exception $e){
            throw new ServiceException($e->getMessage());
        }
    }
}