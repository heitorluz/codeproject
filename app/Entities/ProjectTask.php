<?php

namespace CodeProject\Entities;

class ProjectTask extends AbstractEntity
{
    protected $fillable = ['name','project_id','start_date','due_data','status'];

    public function project(){
        return $this->belongsTo(ProjectTask::class);
    }

}
