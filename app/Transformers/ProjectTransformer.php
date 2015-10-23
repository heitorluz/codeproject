<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:21
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;
use CodeProject\Transformers\ProjectMemberTransformer;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['members'];


    public function transform(Project $project){

        return [
            'project'     => $project->name,
            'description' => $project->description,
            'progress'    => $project->progress,
            'status'      => $project->status,
            'due_date'    => $project->due_date,
        ];
    }

    public function includeMembers(Project $project){
        $members = $project->members;

        return $this->collection($members, new ProjectMemberTransformer);
    }
}