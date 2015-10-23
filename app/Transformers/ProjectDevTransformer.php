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

class ProjectDevTransformer extends TransformerAbstract
{

    public function transform(Project $project){

        return [
            'project_id'  => $project->id,
            'name'        => $project->name,
            'description' => $project->description,
            'progress'    => $project->progress,
            'status'      => $project->status,
            'due_date'    => $project->due_date,
        ];
    }
}