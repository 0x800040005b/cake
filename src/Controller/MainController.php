<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\ResetForm;
use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;
use Exception;

class MainController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index', 'login', 'view', 'resetPassword', 'recovery']);
    }

    public function index()
    {

        $this->Authorization->skipAuthorization();

        $usersTable = $this->fetchTable('Users');

        $users = $usersTable->find('all')->contain(['Roles',])->all();

        if (!$users->isEmpty()) {

            $this->set(compact('users'));
        }
    }


    public function login()
    {

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
            return $this->redirect('main/login');
        }
    }

    public function logout()
    {

        $this->Authorization->skipAuthorization();

        $this->Authentication->logout();

        return $this->redirect(Router::url(['controller' => 'Main', 'action' => 'index']));
    }
    public function resetPassword()
    {
        $this->Authorization->skipAuthorization();

        $resetForm = new ResetForm();


        if ($this->request->is('post')) {

            $usersTable = $this->fetchTable('Users');

            try {
                $query = $usersTable->find('byEmail', ['email' => $this->request->getData('email')]);

                $user = $query->firstOrFail();


                $user->password = $this->generateHash();

                $usersTable->save($user);

                if ($resetForm->execute($this->request->getData())) {

                    $mailer = new Mailer();

                    $mailer->setEmailFormat('html')

                        ->setTo($this->request->getData('email'))

                        ->setFrom('Admin@test.com')
                        ->setViewVars(['url' =>  $this->generateURL($user->password),'email' => $this->request->getData('email')])

                        ->viewBuilder()

                        ->setTemplate('resetPassword');


                    $mailer->deliver();

                    $this->Flash->success('sent successfuly', [
                        'clear' => true,
                    ]);
                    return $this->redirect('main/index');
                }

            } catch (Exception $exception) {

                $this->Flash->error('User Not Found', [

                    'key' => 'password_change',
                    'clear' => true,

                ]);
                return;
            }
        }
    }

    public function recovery()
    {

        $this->Authorization->skipAuthorization();

        if ($this->request->is('get')) {

            $this->request->getSession()->write('r_key', $this->request->getQuery('recovery_key'));
        }

        if ($this->request->is('post')) {

            $usersTable = $this->fetchTable('Users');

            $r_key = $this->request->getSession()->read('r_key');


            try {
                $query = $usersTable->find('byPassword', ['password' => $r_key]);

                $user = $query->firstOrFail();

                $user->password = $this->request->getData('password');

                $this->Flash->error('Password changed successfuly', [

                    'key' => 'password_change',
                    'clear' => true,

                ]);
                
                $usersTable->save($user);

                return $this->redirect('main/login');
                



            } catch (Exception $exception) {
                $this->Flash->error('OOPS password not changed', [

                    'key' => 'password_change',
                    'clear' => true,

                ]);
                

            }finally{
                $this->request->getSession()->delete('r_key');

            }

        }
    }

    private function generateHash()
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randStr = '';
        for ($i = 0; $i < strlen($chars); $i++) {
            $randStr .= $chars[rand(0, 31)];
        }
        return $randStr;
    }

    private function generateURL($hash)
    {

        return Router::url([
            'controller' => 'Main',
            'action' => 'recovery',
            '?' => ['recovery_key' =>  $hash],

        ], true);
    }
}
