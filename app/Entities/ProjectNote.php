<?php

namespace CodeProject\Entities;

class ProjectNote extends AbstractEntity
{
    protected $fillable = ['project_id','title','note'];

    public function project(){
        return $this->belongsTo(Project::class);
    }

}
