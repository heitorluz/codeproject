<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 23/10/15
 * Time: 14:27
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectNoteTransformer;

class ProjectNotePresenter extends AbstractPresenter
{
    public function getTransformer(){
        return new ProjectNoteTransformer();
    }
}