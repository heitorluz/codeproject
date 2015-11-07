<?php

namespace CodeProject\Entities;

class ProjectFile extends AbstractEntity
{
    protected $fillable = ['project_id', 'name', 'description', 'extension'];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
