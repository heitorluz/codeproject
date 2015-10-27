<?php

namespace CodeProject\Entities;

class Client extends AbstractEntity
{
    protected $fillable = array('name', 'responsible', 'email', 'phone', 'address', 'obs');

    public function project(){
        return $this->hasOne(Project::class);
    }
}
