<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 26/10/15
 * Time: 10:23
 */

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;


abstract class AbstractEntity extends Model implements Presentable
{
    use PresentableTrait;
}