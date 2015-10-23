<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 14/10/15
 * Time: 15:45
 */

namespace CodeProject\Http\Controllers;

use CodeProject\Exceptions\ServiceException;
use Illuminate\Http\Request;


abstract class AbstractController extends Controller
{
    /**
     * @var
     */
    protected $service;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->service->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            return $this->service->create($request->all());
        }catch (ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            return $this->service->find($id);
        }catch (ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        }catch(ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            return $this->service->delete($id);
        }catch(ServiceException $e){
            return ['error'=>true, 'message'=>$e->getMessage()];
        }
    }
}