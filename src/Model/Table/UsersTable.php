<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class UsersTable extends Table
{
	public function initialize(array $config)
    {
        parent::initialize($config);

        $this->hasMany('Ips');
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'An email-address is required')
			->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'user']],
                'message' => 'Please enter a valid role'
            ]
			)
			->add('confirm_password',
			    'compareWith', [
			        'rule' => ['compareWith', 'password'],
			        'message' => 'Passwords not equal.'
			    ]
			);
    }
	
	public function findProfile($id) 
	{
		$users = TableRegistry::get('Users');
		return $users->findById($id)->contain(['Ips']);	
	}

}