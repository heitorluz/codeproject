<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 18/09/15
 * Time: 10:49
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
        'name'=>'required|max:255',
        'responsible'=>'required|max:255',
        'email'=>'required|email',
        'phone'=>'requuired',
        'address'=>'required'
    ];
}