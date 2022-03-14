<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;

class MainController extends AppController
{

    public function index()
    {

        $usersTable = $this->fetchTable('Users');
        $users = $usersTable->find('all')->contain(['Roles',])->all();
        if (!$users->isEmpty()) {
            $this->set(compact('users'));
        }
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['index']);
        $this->Authorization->skipAuthorization();
    }

    public function login(){
        
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Users',
                'action' => '',
            ]);
    
            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout(){
        
        $this->Authorization->skipAuthorization();
        $this->Authentication->logout();

        return $this->redirect(Router::url(['controller' => 'Main', 'action' => 'index']));
    }
}
