<?php

class JobPage extends Page
{

}

class JobPageController extends PageController
{
    // Get the job from the params
    public function Job()
    {
        $id = $this->getRequest()->param('jobID');
        return Job::get()->byID($id);
    }
}