<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 16/09/15
 * Time: 19:27
 */

namespace CodeProject\Repositories;

use CodeProject\Entities\Client;
use CodeProject\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model(){
        return User::class;
    }
}