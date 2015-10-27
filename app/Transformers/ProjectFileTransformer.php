<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:21
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\ProjectFile;

class ProjectFileTransformer extends AbstractTransformer
{
    public function transform(ProjectFile $projectFile){

        return [
            'id'          => $projectFile->id,
            'project_id'  => $projectFile->project_id,
            'name'        => $projectFile->name,
            'description' => $projectFile->description,
            'extension'   => $projectFile->extension,
        ];
    }
}