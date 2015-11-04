<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Database\FunctionsBuilder;

/**
 * Ips Controller
 *
 * @property \App\Model\Table\IpsTable $Ips
 */
class IpsController extends AppController
{
	public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
	
	public function beforeFilter(Event $event) {
		$this->Auth->allow(['mapView', 'nodesJson']);
		parent::beforeFilter($event);
	}
	
	public function isAuthorized($user)
	{
	    $action = $this->request->params['action'];
		
		switch ($user['role']) {
			case 'admin': 	return true;
			case 'user':	return in_array(
								$action,
								['request', 'release', 'edit']
							); 
			default:		return in_array($action, ['mapView']);
		}
	    return parent::isAuthorized($user);
	}

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
	
        $this->paginate = [
            'contain' => ['Users'],
            'order' => [(new FunctionsBuilder())->inet_aton(['ip' => 'literal'])]
        ];
		$query = $this->Ips->find();
		if ($this->request->query('sort') === 'ip') {
		    $method = 'orderAsc';
		    if ($this->request->query('direction') === 'desc') {
		        $method = 'orderDesc';
		    }
		    $query->{$method}($query->func()->inet_aton(['ip' => 'literal']));
		}
        $this->set('ips', $this->paginate($query));
        $this->set('_serialize', ['ips']);
    }
	
	/**
     * Index method
     *
     * @return void
     */
    public function mapView()
    {	
		$query = $this->Ips->find();
		$query->contain(['Users' => ['fields' => ['name']]]);
		$query->where('user_id IS NOT NULL');
		if ($this->request->query('sort') === 'ip') {
		    $method = 'orderAsc';
		    if ($this->request->query('direction') === 'desc') {
		        $method = 'orderDesc';
		    }
		    $query->{$method}($query->func()->inet_aton(['ip' => 'literal']));
		}
		$ips = $query;
        $this->set('ips', $ips);
        $this->set('_serialize', true);
    }

	 /**
     * View method
     *
     * @param string|null $id Ip id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ip = $this->Ips->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('ip', $ip);
        $this->set('_serialize', ['ip']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function addRange()
    {
        if ($this->request->is('post')) {
        	$err_msg = '';
        	for ($a = $this->request->data['a_from']; $a <= $this->request->data['a_to']; $a++) {
        		for ($b = $this->request->data['b_from']; $b <= $this->request->data['b_to']; $b++) {
        			for ($c = $this->request->data['c_from']; $c <= $this->request->data['c_to']; $c++) {
        				for ($d = $this->request->data['d_from']; $d <= $this->request->data['d_to']; $d++) {
        					$this->request->data['ip'] = $a . '.' . $b . '.' . $c . '.' . $d;
        					$ip = $this->Ips->newEntity($this->request->data);
							if (!$this->Ips->save($ip)) {
								$err_msg .= $a . '.' . $b . '.' . $c . '.' . $d . ' ' . __(' could not be added to the pool. Maybe it already exists?') . "<br>";
							} 
						}
					}
				}	
        	}
			if ($err_msg == '') {
                $this->Flash->success(__('The IPs have been saved.'));
            } else {
                $this->Flash->error($err_msg);
            }
			return $this->redirect(['action' => 'index']);
        }
		$ip = $this->Ips->newEntity();	
		$query = $this->Ips->find();
		$current_max = $query->orderDesc($query->func()->inet_aton(['ip' => 'literal']))->first();
		$this->set('current_max', $current_max);
		$this->set(compact('ip'));
        $this->set('_serialize', ['ip']);	
    }
	
	/**
	 *  Request method
	 * 
	 *  @return void Assigns first unused IP to the User requesting it
	 * 
	 */
	 
	 public function request() {
	 	$count = $this->Ips->find('all')->where(['user_id' => $this->Auth->user('id')])->count();
		if ($count >= $this->Auth->user('max_ips')) {
			$this->Flash->error(__('Your maximum amount of IPs has been reached. Please contact your local community.'));
			return $this->redirect(['controller' => 'Users', 'action' => 'profile']);	
		}
	 	$ip = $this->Ips->find('all')->where(['user_id is null'])->first();
		if (count($ip) === 0) 
		{
			$this->Flash->error(__('There are currently no IPs available'));
			return $this->redirect(['controller' => 'Users', 'action' => 'profile']);	
		}
		$ip->user_id = $this->Auth->user('id');
		if ($this->Ips->save($ip)) {
            $this->Flash->success(__('The ip has been saved.'));
        } else {
            $this->Flash->error(__('The ip could not be saved. Please, try again.'));
        }
		return $this->redirect(['controller' => 'Users', 'action' => 'profile']);		
	 }
	 
	 /**
	 *  Release method
	 * 
	 *  @return void Releases used IP to the pool
	 * 
	 */
	 
	 public function release($id) {
	 	$ip = $this->Ips->find('all')->where(['id' => $id])->first();
		if ($ip->user_id != $this->Auth->user('id') && $this->Auth->user('role') != 'admin') {
			$this->Flash->error(__('The IP is not assigned to you right now and therefor cannot be released.'));
			return $this->redirect(['controller' => 'Users', 'action' => 'profile']);	
		}
		$ip->user_id = null;
		$ip->description = null;
		$ip->lat = null;
		$ip->lon = null;
		if ($this->Ips->save($ip)) {
            $this->Flash->success(__('The IP has been released.'));
        } else {
            $this->Flash->error(__('The IP could not be released. Please, try again.'));
        }
		return $this->redirect($this->referer());		
	 }
	
	
    /**
     * Edit method
     *
     * @param string|null $id Ip id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ip = $this->Ips->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ip = $this->Ips->patchEntity($ip, $this->request->data);
            if ($this->Ips->save($ip)) {
                $this->Flash->success(__('The IP has been saved.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'profile']);	
            } else {
                $this->Flash->error(__('The IP could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ip'));
        $this->set('_serialize', ['ip']);	
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
        $ip = $this->Ips->get($id);
        if ($this->Ips->delete($ip)) {
            $this->Flash->success(__('The ip has been deleted.'));
        } else {
            $this->Flash->error(__('The ip could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
