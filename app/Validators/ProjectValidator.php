<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 18/09/15
 * Time: 10:49
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'name'=>'required|max:255',
        'description'=>'required|max:255',
        'status'=>'required|max:1',
        'owner_id'=>'required',
        'client_id'=>'required',
    ];
}