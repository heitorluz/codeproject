<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:21
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\Project;
use CodeProject\Transformers\ProjectMemberTransformer;

class ProjectTransformer extends AbstractTransformer
{

    //protected $defaultIncludes = ['members'];

    public function transform(Project $project){
        return [
            'id'          => $project->id,
            'owner_id'    => $project->owner_id,
            'client_id'   => $project->client_id,
            'name'        => $project->name,
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