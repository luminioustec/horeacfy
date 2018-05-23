<?php 
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

// ...
public $hasOne = 'Customer';
	
public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new BlowfishPasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
    }
    return true;
}
	public $validate = array(
        'username' => array(
                'rule' => 'isUnique',
                'message' => 'By “Este nombre ya ha sido utilizado anteriormente'
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required'
            )
        ),
        'typeOfbusiness' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A typeOfbusiness is required'
            )
        ),
		 'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A name is required'
            )
        ),
		 'contactName' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A contact Name is required'
            )
        ),
		 'contactEmail' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A contact Email is required'
            )
        ),
		 'contactMobile' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A contact Mobile is required'
            )
        ),
		 'address' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A Address is required'
            )
        ),
		 'city' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A city is required'
            )
        ),
		 'zipcode' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A zipcode is required'
            )
        ),
		 'province' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A province is required'
            )
        ),
		 'country' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A country is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('customer', 'wholesaler')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

}