<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Routing\Router;
use Exception;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{


    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index', 'login', 'view']);
    }



    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if(is_null($this->getLoggedUser())){

            return $this->redirect('main/logout');
            
        }
        $this->Authorization->skipAuthorization();
        $this->paginate = [
            'contain' => ['Roles'],
        ];

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('loggedUser', $this->getLoggedUser());
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $this->Authorization->skipAuthorization();

        $user = $this->Users->get($id, [
            'contain' => ['Roles'],

        ]);



        $this->set(compact('user'));
        $this->set('loggedUser', $this->getLoggedUser());
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       
            $this->Authorization->authorize($this->getLoggedUser());
    
            $user = $this->Users->newEmptyEntity();


        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $roleTable = $this->getTableLocator()->get('Roles');

            $role = $roleTable->get($data['roles']['_ids']);


            $data['roles'] = [
                'role' => [
                    'id' => $role->id,
                    'name' => $role->name,
                ]
            ];
            


            $user = $this->Users->newEntity($data,[
                'associated' => ['Roles'],
            ]);
    

            if ($this->Users->save($user)) {

                $this->Flash->success(__('The user has been saved.'),['clear' => true]);


                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'),['clear' => true]);
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->all();

        $this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

            $this->Authorization->authorize($this->getLoggedUser());


        $user = $this->Users->get($id, [

            'contain' => ['Roles'],

        ]);




        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            $roleTable = $this->getTableLocator()->get('Roles');

            $role = $roleTable->get($data['roles']['_ids']);


            $data['roles'] = [
                'role' => [
                    'id' => $role->id,
                    'name' => $role->name,
                ]
            ];
            

            $user = $this->Users->patchEntity($user, $data,[
                
                'associated' => 'Roles'
            ]);

            if ($this->Users->save($user)) {

                $this->Flash->success(__('The user has been saved.'),['clear' => true]);


                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'),['clear' => true]);
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->all();

        $this->set(compact('user', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $this->Authorization->authorize($this->getLoggedUser());

        $this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($id);

        if ($this->Users->delete($user)) {

            $this->Flash->success(__('The user has been deleted.'),['clear' => true]);
        } else {

            $this->Flash->error(__('The user could not be deleted. Please, try again.'),['clear' => true]);
        }


        return $this->redirect(['action' => 'index']);
    }



    private function getLoggedUser()
    {
        try {

            $loggedUser = $this->fetchTable('Users')->get($this->request->getAttribute('identity')->id, [

                'contain' => ['Roles'],

            ]);
            return $loggedUser;
        } catch (Exception $ex) {

          
            return null;
        }
    }


}
