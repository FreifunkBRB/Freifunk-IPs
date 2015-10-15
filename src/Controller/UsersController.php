<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['register', 'logout']);
    }
	
	public function isAuthorized($user)
	{
	    $action = $this->request->params['action'];
		switch ($user['role']) {
			case 'admin': 	return true;
			case 'user':	return in_array(
								$action,
								['profile', 'editProfile', 'resetPassword']
							); 
		}
	    return parent::isAuthorized($user);
	}
	
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ips'],
            'order' => ['username']
        ];
		 $this->set('users', $this->paginate($this->Users->find('all')));
        $this->set('_serialize', ['users']);
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }
	
	public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Ips']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);	
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);	
    }
	
	public function resetPassword($id = null)
    {
    	$redirect = $id == null ? 'profile' : 'index';	
        if ($id == null) {
        	$id = $this->Auth->user('id');
        } else if ($id != $this->Auth->user('id') && $this->Auth->user('role') != 'admin') {
        	$this->Flash->error(__('You are not allowed to perform this action!'));
			$this->redirect($this->referer());
        }
			
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The password has been changed.'));
                return $this->redirect(['controller' => 'Users', 'action' => $redirect]);	
            } else {
                $this->Flash->error(__('The password could not be saved. Please, try again.'));
            }
        }
		$user->unsetProperty('password');
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);	
    }

	public function editProfile()
    {
       	$id = $this->Auth->user('id');
       	$user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The profil has been changed.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'profile']);	
            } else {
                $this->Flash->error(__('The profile could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);	
    }
	
	public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
			$user->role = 'user';
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }
	
	public function login()
	{
	    if ($this->request->is('post')) {
	        $user = $this->Auth->identify();
	        if ($user) {
	            $this->Auth->setUser($user);
	            return $this->redirect($this->Auth->redirectUrl());
	        }
	        $this->Flash->error(__('Invalid username or password, try again'). (new DefaultPasswordHasher)->hash($user->password));
	    }
	}
	
	public function logout()
	{
	    return $this->redirect($this->Auth->logout());
	}
	
	public function profile() 
	{
		$user = $this->Users->get($this->Auth->user('id'), [
			'contain' => ['Ips']
		]);
        $this->set('user', $user);
		$this->set('_serialize', ['user']);
	}
	
	 /**
     * Delete method
     *
     * @param string|null $id Ip id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ip = $this->Users->get($id);
        if ($this->Users->delete($ip)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
}