<?php 

App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $helpers  = array('Html', 'Form');
    public $components = array('RequestHandler','Session');
	public $uses= array('User','Customer','Wholesaler','TypeOfBusiness');
    // app/Controller/UsersController.php

	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		$this->Auth->allow('add_restauradores','add_distribuidores', 'logout','login','index');
		$roles= $this->Auth->user('role');
		$this->set('roles',$roles);	
	}


	
	public function login() {
		$this->layout='frontend';
		if ($this->request->is('post')) {  
	        if ($this->Auth->login()) {
	        	 $this->Session->setFlash(__('Welcome '.$this->Auth->user('username')));
				$url  =  $this->Auth->redirect(); //echo $this->Auth->user('role'); die;
	            if(!empty($_GET['referer'])){
					$url  =  SITE_URL. urldecode( $_GET['referer'] );
				} else if($this->Auth->user('role')=='customer'){  
					$url  =  array('controller'=> 'customers', 'action'=> 'choose_category');
				} else if($this->Auth->user('role')=='wholesaler'){  
					$url  =  array('controller'=> 'wholesalers', 'action'=> 'create_your_lists');
				} else if($this->Auth->user('role')=='admin'){
					$url  =  array('controller'=> 'admins', 'action'=> 'index');
				}
				if(empty($url)){
					$url = SITE_URL;
				}	 
				return $this->redirect($url);
	        } else{
				$this->Session->setFlash('Usario o contraseña incorrectosUsario o contraseña incorrectos','error');
			}
			
			//print_r($this->request->data['User']); print_r($this->User); die;
	        //$this->Session->setFlash(__('Invalid username or password, try again','error'));
	    }
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

    public function index() {
		$this->layout='frontend';
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add_restauradores() {
		$this->layout='frontend';
		$tob=$this->TypeOfBusiness->find('list',array('fields'=>array('name')));
		$this->set('tob',$tob);
        if ($this->request->is('post')) { //pr($this->data); die;
		$req=$this->request->data['User']; 
		$user_type=$req['role'];
		$array_u=array('username'=>$req['username'],'password'=>$req['password'],'role'=>$req['role']);
		$this->User->create();
		if ($this->User->save($array_u)) {
		$insertId = $this->User->getLastInsertId();
		$array_r=array('user_id'=>$insertId,'vat'=>$req['vat'],'name'=>$req['name'],'contactName'=>$req['contactName'],'contactEmail'=>$req['contactEmail'],'contactMobile'=>$req['contactMobile'],'address'=>$req['address'],'city'=>$req['city'],'zipcode'=>$req['zipcode'],'province'=>$req['province'],'country'=>$req['country']);
		$this->Customer->save($array_r);
		$user = $this->User->findById($insertId);
		$user = $user['User'];
		$this->Auth->login($user);
		$this->Session->setFlash(__('La cuenta ha sido creada','success'));
                $this->redirect(array('controller' => 'customers','action'=>'choose_category'));
            } else {
                $this->Session->setFlash(__('No se ha podido crear la cuenta','error'));
            }
	}
	}
	
	public function add_distribuidores() {
		$this->layout='frontend';
		$tob=$this->TypeOfBusiness->find('list',array('fields'=>array('name')));
		$this->set('tob',$tob);
        if ($this->request->is('post')) { //pr($this->data); die;
		$req=$this->request->data['User']; 
		$user_type=$req['role'];
		$array_u=array('username'=>$req['username'],'password'=>$req['password'],'role'=>$req['role']);
		$this->User->create();
		if ($this->User->save($array_u)) {
		$insertId = $this->User->getLastInsertId();
		$array_r=array('hiddenid'=>$insertId,'vat'=>$req['vat'],'name'=>$req['name'],'contactName'=>$req['contactName'],'contactEmail'=>$req['contactEmail'],'contactMobile'=>$req['contactMobile'],'address'=>$req['address'],'city'=>$req['city'],'zipcode'=>$req['zipcode'],'province'=>$req['province'],'country'=>$req['country']);
		$this->Wholesaler->save($array_r);
		$user = $this->User->findById($insertId);
		$user = $user['User'];
		$this->Auth->login($user);
    $this->Session->setFlash(__('Bienvenido a Horecafy','success'));
                $this->redirect(array('controller' => 'wholesalers','action'=>'create_your_lists'));
            } else {
                $this->Session->setFlash(__('No se ha podido crear la cuenta','error'));
            }
	}
	}

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.','error')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted','success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted','error'));
        return $this->redirect(array('action' => 'index'));
    }

}