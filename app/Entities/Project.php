<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

class Project extends Model implements Presentable
{
    use PresentableTrait;

    protected $fillable = ['owner_id', 'client_id', 'name', 'description', 'progress', 'status', 'due_date'];

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function notes(){
        return $this->hasMany(ProjectNote::class);
    }

    public function tasks(){
        return $this->hasMany(ProjectTask::class);
    }

    public function members(){
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'member_id');
    }
}
