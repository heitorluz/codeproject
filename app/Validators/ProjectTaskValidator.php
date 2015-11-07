<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 18/09/15
 * Time: 10:49
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' =>'required',
        'name'       =>'required',
        'start_date' =>'required',
        'due_date'   =>'required',
        'status'     =>'required',
    ];
}