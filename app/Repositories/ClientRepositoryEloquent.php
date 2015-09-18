<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 16/09/15
 * Time: 19:27
 */

namespace CodeProject\Repositories;

use CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model(){
        return Client::class;
    }
}