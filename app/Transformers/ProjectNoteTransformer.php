<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:21
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends AbstractTransformer
{
    public function transform(ProjectNote $projectNote){

        return [
            'id'            => $projectNote->id,
            'project_id'    => $projectNote->project_id,
            'title'         => $projectNote->title,
            'note'          => $projectNote->note,
        ];
    }
}