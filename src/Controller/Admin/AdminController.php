<?php

namespace App\Controller\Admin;

use App\Controller\AppController;

class AdminController extends AppController {

    public function index(){
        $this->set('title','from Controller');
        $this->viewBuilder()->setLayout('admin/main');
    }

    public function edit($id){
        echo $id;
    }

    public function delete($id){
        echo $id;
    }

    public function insert(){

    }

}