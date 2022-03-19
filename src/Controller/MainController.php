<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\ResetForm;
use App\Model\Entity\User;
use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;
use Exception;

class MainController extends AppController
{

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
            '?' => ['r_key' =>  $hash],

        ], true);
    }

    protected function sendRecoveryURL(User $user){

        $url = $this->generateURL($user->password);

        $mailer = new Mailer('default');

        $mailer->setEmailFormat('html')

                ->setFrom('Admin@mail.com')

                ->setTo($user->email)

                ->setViewVars(['url' => $url, 'email' => $user->email])

                ->viewBuilder()

                    ->setTemplate('reset_password');

        $mailer->deliver();
    }

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

            $this->Flash->error(__('Invalid username or password'), [
                'key' => 'data_login',
                'clear' => true,
            ]);
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

            if ($resetForm->execute($this->request->getData())) {

                $usersTable = $this->getTableLocator()->get('users');

                $query = $usersTable->find('byEmail', ['email' => $this->request->getData('email')]);

                $user = $query->first();

                if ($user) {

                    $user->password = $this->generateHash();

                    $usersTable->save($user);

                    $this->sendRecoveryURL($user);

                    $this->Flash->success('Sent Successfuly', ['clear' => true]);

                    return $this->redirect('main/resetPassword');

                } else {

                    $this->Flash->error('User Not Found', ['clear' => true]);

                    return $this->redirect('main/resetPassword');
                }
            } else {

                $this->Flash->error('invalid email', ['clear' => true]);
            }
        }
    }

    public function recovery()
    {

        $this->Authorization->skipAuthorization();

        if ($this->request->is('get')) {

            $this->request->getSession()->write('r_key', $this->request->getQuery('r_key'));
        }

        if ($this->request->is('post')) {

            $usersTable = $this->fetchTable('Users');

            $r_key = $this->request->getSession()->read('r_key');

            $query = $usersTable->find('byPassword', ['password' => $r_key]);

            $user = $query->first();

            if ($user) {

                $user->password = $this->request->getData('password');

                $this->Flash->error('Password changed successfuly', [

                    'key' => 'data_login',
                    'clear' => true,

                ]);

                $usersTable->save($user);


            } else {

                $this->Flash->error('OOPS password not changed', [

                    'key' => 'data_login',
                    'clear' => true,

                ]);

               
            }
            $this->request->getSession()->delete('r_key');

            return $this->redirect('main/login');

        }
    }

}
