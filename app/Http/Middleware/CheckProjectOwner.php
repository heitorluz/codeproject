<?php

namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Services\ProjectService;

class CheckProjectOwner
{

    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectService $service){
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $userId    = \Authorizer::getResourceOwnerId();
        $projectId = $request->project;

        if ($this->service->isOwner($projectId, $userId) == false){
            return ['sucess'=>false];
        }


        return $next($request);
    }
}
