<?php

namespace App\Controller;

use App\Controller\AppController;

class MainController extends AppController
{

    public function index(){

        $usersTable = $this->fetchTable('Users');
        $users = $usersTable->find('all')->contain(['Roles',])->all();
        if(!$users->isEmpty()){
            $this->set(compact('users'));
        }
    }
}