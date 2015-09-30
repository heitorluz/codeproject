<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 16/09/15
 * Time: 19:27
 */

namespace CodeProject\Repositories;

use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model(){
        return Project::class;
    }
}