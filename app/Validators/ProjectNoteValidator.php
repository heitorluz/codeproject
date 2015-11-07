<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 18/09/15
 * Time: 10:49
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' =>'required',
        'title'      =>'required',
        'note'       =>'required',
    ];
}