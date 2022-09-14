<?php


namespace App\Controllers;

use SON\Controller\Action;
use App\Models\Upload;

class System extends Action
{

    public function upload()
    {
        if($_POST){
            $return = new Upload(\App\Init::getDb());
            $return->load();
            if(!$return->catch){
                $this->view->success = $return->success;
                $this->view->error = $return->error;
                $this->view->info = $return->info;
            }else{
                $this->view->error = $return->catch;
            }
        }
        $this->render('upload');
    }

    public function customers()
    {
        $this->render('customers');
    }

    public function list()
    {
        $this->render('list');
    }


}