<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 17/09/15
 * Time: 15:49
 */

namespace CodeProject\Validators;


class ClientValidator
{
    protected $rules = [
        'name'=>'required|max:255',
        'responsible'=>'required|max:255',
        'email'=>'required|email',
        'phone'=>'required',
        'address'=>'required'
    ];
}