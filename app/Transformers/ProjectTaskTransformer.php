<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:21
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\ProjectTask;

class ProjectTaskTransformer extends AbstractTransformer
{
    public function transform(ProjectTask $projectTask){

        return [
            'id'         => $projectTask->id,
            'project_id' => $projectTask->project_id,
            'start_date' => $projectTask->start_date,
            'due_date'   => $projectTask->due_date,
            'status'     => $projectTask->status,
        ];
    }
}