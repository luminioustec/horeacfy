<?php 

// app/Controller/UsersController.php
App::uses('AppController', 'Controller');
class AdminsController extends AppController {
	public $helpers  = array('Html', 'Form');
    public $components = array('RequestHandler','Session','Paginator','Csv');
	public $uses= array('Customer','Wholesaler','Category','Family','TypeOfFormat','TypeOfBusiness');
	 

	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		$this->Auth->allow();
		$email= $this->Auth->user('email'); 
		$this->set('email',$email); 
		ini_set('memory_limit', '-1'); 
		$roles= $this->Auth->user('role');
		$this->set('roles',$roles);	
		$options = array(
			// Refer to php.net fgetcsv for more information
			'length' => 0,
			'delimiter' => ',',
			'enclosure' => '"',
			'escape' => '\\',
			// Generates a Model.field headings row from the csv file
			'headers' => true, 
			// If true, String $content is the data, not a path to the file
			'text' => false,
		);
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

    public function index() {
		$this->layout='backend';
        //$this->User->recursive = 0;
        //$this->set('users', $this->paginate());
    }
	

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function categories() {
		$this->layout='backend';
		$categories=$this->Category->find('all');
		$this->set('categories',$categories);
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash('The Category has been saved','success');
                return $this->redirect(array('action' => 'categories'));
            }
            $this->Session->setFlash('The Category could not be saved. Please, try again.','error');
        }
    }
	public function edit_category($id = null) {
		$this->layout='backend';
    if (!$id) {
        throw new NotFoundException(__('Invalid Category'));
    }

    $post = $this->Category->findById($id);
	$this->set('post',$post);
    if (!$post) {
        throw new NotFoundException(__('Invalid Category'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->Category->id = $id;
        if ($this->Category->save($this->request->data)) {
            $this->Session->setFlash('Your Category has been updated.','success');
            return $this->redirect(array('action' => 'categories'));
        }
        $this->Session->setFlash('Unable to update your Category.','error');
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}


    public function delete_categories($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->Category->delete()) {
            $this->Session->setFlash('Category deleted','success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Category was not deleted','error');
        return $this->redirect(array('action' => 'index'));
    }
	

	
	public function import() {
		$this->layout='backend';
		
		/* set_time_limit(0);
		$conn = mysqli_connect('204.93.216.11','LTNet_fsms','caLC1234@','ltnet_horecafy');
         if($this->request->is('post')){ //pr($this->request->data); die;
		
		$filename=$this->request->data["Family"]["file"]["tmp_name"];		
 
 
		 if($this->request->data["Family"]["file"]["size"] > 0)
		 {
		  	$file = $this->request->data["Family"]['file']['tmp_name'];
		$csv = array_map('str_getcsv', file($file));
		//pr($csv); die;
		foreach($csv as $key => $value){	
			$value0 = mysqli_real_escape_string($conn ,$value[0]);
			$value1 = mysqli_real_escape_string($conn ,$value[1]);
			$value2 = mysqli_real_escape_string($conn ,$value[2]);
			mysqli_query($conn , "insert into families (name,categoryId,visible) values('".$value0."','".$value1."','".$value2."')");
			
                
		}
		return $this->redirect(array('action' => 'families'));
			 die;
	         //fclose($file);	
		 }
	}	  */
    }
	
	 public function families() {
		$this->layout='backend';
		//$cats=$this->Category->find('list',array('fields'=>array('Category.name')));
		$cats = $this->Category->find('list', array(
        'fields' => array('Category.id','Category.name')
    ));
		$this->set('cats',$cats);


    $families = $this->Family->find('all',array('conditions'=>array('Family.categoryId !='=>'')));
	$this->set('families',$families);
   
     
    //pr($families);
        if ($this->request->is('post')) {
            $this->Family->create();
            if ($this->Family->save($this->request->data)) {
                $this->Session->setFlash('Family has been saved','success');
                return $this->redirect(array('action' => 'families'));
            }
            $this->Session->setFlash('The user could not be saved. Please, try again.','error');
        }
    }
	
	public function edit_family($id = null) {
		$this->layout='backend';
    if (!$id) {
        throw new NotFoundException(__('Invalid Family'));
    }

    $post = $this->Family->findById($id);
	$this->set('post',$post);
    if (!$post) {
        throw new NotFoundException(__('Invalid Family'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->Family->id = $id;
        if ($this->Family->save($this->request->data)) {
            $this->Session->setFlash('Your Family has been updated.','success');
            return $this->redirect(array('action' => 'families'));
        }
        $this->Session->setFlash('Unable to update your Family.','error');
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}
	public function delete_family($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->Family->id = $id;
        if (!$this->Family->exists()) {
            throw new NotFoundException(__('Invalid family'));
        }
        if ($this->Family->delete()) {
            $this->Session->setFlash('Family deleted','error');
            return $this->redirect(array('action' => 'families'));
        }
        $this->Session->setFlash('Family was not deleted','error');
        return $this->redirect(array('action' => 'families'));
    }
	
	public function typeOfFormat(){
		$this->layout='backend';
	$tof=$this->TypeOfFormat->find('all');
	$this->set('tof',$tof);	
	 if ($this->request->is('post')) {
            $this->TypeOfFormat->create();
            if ($this->TypeOfFormat->save($this->request->data)) {
                $this->Session->setFlash('The TypeOfFormat has been saved','success');
                return $this->redirect(array('action' => 'typeOfFormat'));
            }
            $this->Session->setFlash('The user could not be saved. Please, try again.','error');
        }
		
	}
	public function edit_typeofformat($id = null) {
		$this->layout='backend';
    if (!$id) {
        throw new NotFoundException(__('Invalid TypeOfFormat'));
    }

    $post = $this->TypeOfFormat->findById($id);
	$this->set('post',$post);
    if (!$post) {
        throw new NotFoundException(__('Invalid TypeOfFormat'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->TypeOfFormat->id = $id;
        if ($this->TypeOfFormat->save($this->request->data)) {
            $this->Session->setFlash('Your TypeOfFormat has been updated.','success');
            return $this->redirect(array('action' => 'typeOfFormat'));
        }
        $this->Session->setFlash('Unable to update your typeOfFormat.','error');
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}
	public function delete_typeofformat($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->TypeOfFormat->id = $id;
        if (!$this->TypeOfFormat->exists()) {
            throw new NotFoundException(__('Invalid TypeOfFormat'));
        }
        if ($this->TypeOfFormat->delete()) {
            $this->Session->setFlash('TypeOfFormat deleted','success');
            return $this->redirect(array('action' => 'typeOfFormat'));
        }
        $this->Session->setFlash('TypeOfFormat was not deleted','error');
        return $this->redirect(array('action' => 'typeOfBusiness'));
    }
	
	public function impexp_families() {
	$this->layout='backend';
	$conn = mysqli_connect('204.93.216.11','LTNet_fsms','caLC1234@','ltnet_horecafy');
	$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	$allow = null;
         if($this->request->is('post')){ //pr($this->request->data); die;
		

		$filename=$this->request->data["Family"]["file"]["tmp_name"];		

		 if(($this->request->data["Family"]["file"]["size"] > 0) and (in_array($this->request->data["Family"]["file"]["type"],$mimes))) {
		$file = $this->request->data["Family"]['file']['tmp_name'];
		$csv = array_map('str_getcsv', file($file));
		//pr($csv); die;
		foreach(array_slice($csv, 1) as $key => $value){	
			/* $value0 =  preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $value[0]);
			$value1 =  preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $value[1]);
			$value2 =  preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $value[2]);
			
		$savethis=array('name'=>$value0,'categoryId'=>$value1,'visible'=>$value2);
		$this->Family->saveAll($savethis); */
			 $value0 = mysqli_real_escape_string($conn ,$value[0]);
			$value1 = mysqli_real_escape_string($conn ,$value[1]);
			$value2 = mysqli_real_escape_string($conn ,$value[2]);
			mysqli_query($conn , "insert into families (name,categoryId,visible) values('".$value0."','".$value1."','".$value2."')"); 
			
                
		}
		$this->Session->setFlash('Data imported sucessfully!','success');
		return $this->redirect(array('action' => 'impexp_families'));
			 //die;
	         fclose($file);	
		 }else{
			$this->Session->setFlash('Sorry, file/mime type is not allowed','error');
			return $this->redirect(array('action' => 'impexp_families'));
		 }
	}
	
	}
	
	public function impexp_categories() {
	$this->layout='backend';
	$conn = mysqli_connect('204.93.216.11','LTNet_fsms','caLC1234@','ltnet_horecafy');
	$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	$allow = null;
         if($this->request->is('post')){ //pr($this->request->data); die;
		

		$filename=$this->request->data["Category"]["file"]["tmp_name"];		

		 if(($this->request->data["Category"]["file"]["size"] > 0) and (in_array($this->request->data["Category"]["file"]["type"],$mimes))) {
		$file = $this->request->data["Category"]['file']['tmp_name'];
		$csv = array_map('str_getcsv', file($file));
		//pr($csv); die;
		foreach(array_slice($csv, 1) as $key => $value){	
			/* $value0 =  preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $value[0]);
			$value1 =  preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $value[1]);
			$value2 =  preg_replace("/[^{$allow}a-zA-Z0-9]/", '', $value[2]);
			
		$savethis=array('name'=>$value0,'categoryId'=>$value1,'visible'=>$value2);
		$this->Family->saveAll($savethis); */
			 $value0 = mysqli_real_escape_string($conn ,$value[0]);
			$value1 = mysqli_real_escape_string($conn ,$value[1]);
			$value2 = mysqli_real_escape_string($conn ,$value[2]);
			mysqli_query($conn , "insert into categories (name,image,visible) values('".$value0."','".$value1."','".$value2."')"); 
			
                
		}
		$this->Session->setFlash('Data imported sucessfully!','success');
		return $this->redirect(array('action' => 'impexp_families'));
			 //die;
	         fclose($file);	
		 }else{
			$this->Session->setFlash('Sorry, file/mime type is not allowed','error');
			return $this->redirect(array('action' => 'impexp_families'));
		 }
	}
	
	}
	
	public function typeOfBusiness(){
		$this->layout='backend';
	$tob=$this->TypeOfBusiness->find('all');
	$this->set('tob',$tob);	
	 if ($this->request->is('post')) {
            $this->TypeOfBusiness->create();
            if ($this->TypeOfBusiness->save($this->request->data)) {
                $this->Session->setFlash('The TypeOfBusiness has been saved','succsess');
                return $this->redirect(array('action' => 'typeOfBusiness'));
            }
            $this->Session->setFlash('The user could not be saved. Please, try again.','error');
        }
		
	}
	
	public function edit_business($id = null) {
		$this->layout='backend';
    if (!$id) {
        throw new NotFoundException(__('Invalid TypeOfBusiness'));
    }

    $post = $this->TypeOfBusiness->findById($id);
	$this->set('post',$post);
    if (!$post) {
        throw new NotFoundException(__('Invalid TypeOfBusiness'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->TypeOfBusiness->id = $id;
        if ($this->TypeOfBusiness->save($this->request->data)) {
            $this->Session->setFlash('Your TypeOfBusiness has been updated.','success');
            return $this->redirect(array('action' => 'typeOfBusiness'));
        }
        $this->Session->setFlash('Unable to update your TypeOfBusiness.','error');
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}
	public function delete_business($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->TypeOfBusiness->id = $id;
        if (!$this->TypeOfBusiness->exists()) {
            throw new NotFoundException(__('Invalid TypeOfBusiness'));
        }
        if ($this->TypeOfBusiness->delete()) {
            $this->Session->setFlash('TypeOfBusiness deleted','success');
            return $this->redirect(array('action' => 'families'));
        }
        $this->Session->setFlash('TypeOfBusiness was not deleted','error');
        return $this->redirect(array('action' => 'typeOfBusiness'));
    }

}