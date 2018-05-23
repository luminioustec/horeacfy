<?php 

// app/Controller/UsersController.php
App::uses('AppController', 'Controller');

class CustomersController extends AppController {
	public $helpers  = array('Html', 'Form');
    public $components = array('RequestHandler','Session','Paginator');
	public $uses= array('Customer','Wholesaler','Category','Family','Demand','TypeOfFormat','Wholesalerlist','Offer');

	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		$this->Auth->allow();
		$email= $this->Auth->user('email'); 
		$this->set('email',$email);
		$roles= $this->Auth->user('role');
		$this->set('roles',$roles);	
		$customer_id= $this->Auth->user('id');
		$login_name=$this->Customer->find('first',array('fields'=>array('name'),'conditions'=>array('Customer.user_id'=>$customer_id)));
		$this->set('login_name',$login_name);
		$unsharedemandscount=$this->Demand->find('count',array('conditions'=>array('AND'=>
		array('Demand.customerId'=>$customer_id),
		array('Demand.sentTo'=>NULL))));
		$this->set('unsharedemandscount',$unsharedemandscount); 
		
		ini_set('memory_limit', '-1'); 
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
	
	protected function humanTiming ($time) {
	 $cur_time = strtotime(date('H:i:s'));
	 //echo $cur_time;
	 
		$time = $cur_time - $time; // to get the time since that moment
		$time = ($time<1)? 1 : $time;
		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}
	}

    public function index() {
		$this->layout='backend';
        //$this->User->recursive = 0;
        //$this->set('users', $this->paginate());
    }
	
	public function generatekey(){
		$password = '';
		$length = 20;
		 $chars = array_merge(range(0,9), range('A','Z'));
		shuffle($chars);
		for ($i = 0; $i < $length; $i++) {
			if ( $i != 0 && $i % 4 == 0 ) { // nonzero and divisible by 4
				$password .= '-';
			}
			$password .= $chars[mt_rand(0, count($chars) - 1)];
		}
		return $password;
		
	}
    public function add_demand($cat_id=null,$family_id=null) {
	$this->layout='backend';
	$catid=base64_decode($cat_id);
	$familyid=base64_decode($family_id);
	$family_name=$this->Family->find('first',array('conditions'=>array('Family.id'=>$familyid)));
	$this->set('family_name',$family_name);
	$category_name=$this->Category->find('first',array('conditions'=>array('Category.id'=>$catid)));
	$this->set('category_name',$category_name);
	$tof=$this->TypeOfFormat->find('list',array('fields' => array('TypeOfFormat.id','TypeOfFormat.name')));
	$this->set('tof',$tof);
	$customerId= $this->Auth->user('id'); 
        if ($this->request->is('post')) { //pr($this->data); die;
			$randkey= $this->generatekey();
			$this->request->data['Demand']['id']=$randkey;
			$this->request->data['Demand']['familyId']=$familyid;
			$this->request->data['Demand']['customerId']=$customerId;
            $this->Demand->create();
            if ($this->Demand->save($this->request->data)) {
                $this->Session->setFlash('La familia ha sido añadida','success');
                return $this->redirect(array('action' => 'all_demands'));
            }
            $this->Session->setFlash('la familia no se pudo agregar','error');
        }
    }
	
	 public function choose_category () {
		$this->layout='backend';
		$allcats=$this->Category->find('all',array('fields'=>array('Category.name','Category.image','Category.id'),'conditions'=>array('Category.visible'=>1)));
		$this->set('allcats',$allcats);		
		//$this->Category->findById($id);	
	 
	 }
	public function choose_family($cat_id=null){
		$this->layout='backend';
		$customer_id= $this->Auth->user('id');
		$this->set('cat_id',$cat_id);
		$cid=base64_decode($cat_id); 
		$cat_image = $this->Category->findById($cid);
		$this->set('cat_image',$cat_image);
		$check_family_id=$this->Demand->find('list',array('fields'=>array('hiddenId','familyId'),'conditions'=>array('Demand.customerId'=>$customer_id))); //pr($check_family_id);
		$families=$this->Family->find('all',array('conditions'=>array('AND'=>
		array('Family.categoryId'=>$cid),
		array('Family.id !='=>$check_family_id)
		),'fields' => array('Family.id','Family.name')));
		$this->set('families',$families);
		
	} 
	
	
	public function all_demands() {
		$this->layout='backend';
		$customer_id= $this->Auth->user('id'); 
		$demands=$this->Demand->find('all',array('conditions'=>array('Demand.customerId'=>$customer_id),'recursive'=>2,'order' => array('Demand.id ASC')));
		$this->set('demands',$demands); //pr($demands);
    }
	
	public function share_demand($demand_id=null,$family_id=null){
		$this->layout='backend';
	$dem_id=base64_decode($demand_id);	
	$fam_id=base64_decode($family_id);	
	$search_result=$this->Wholesalerlist->find('all',array('conditions'=>array('Wholesalerlist.familyId'=>$fam_id)));
	//pr($search_result); die;
	if(empty($search_result)) {
		$this->Session->setFlash('No hay ningún distribuidor que comercialice esa familia de productos. En breves días buscaremos alguna empresa que se interese por tu solicitud. Gracias.','info');
		return $this->redirect(array('action' => 'all_demands'));	
	}else{
		
	foreach($search_result as $key=>$get){	
	$wholeSalerId=$get['Wholesalerlist']['wholeSalerId'];
	$wholeSalerList_id=$get['Wholesalerlist']['id'];
	$this->Demand->updateAll(array('Demand.sentTo'=>"'".$wholeSalerId."'",'Demand.sentToWholeSalerList'=>"'".$wholeSalerList_id."'"),array('Demand.id'=>$dem_id));
		}
	$this->Session->setFlash('Hemos enviado a los distribuidores que comercializan este producto tu solicitud.','success');	
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
            $this->Flash->success(__('Your Category has been updated.'));
            return $this->redirect(array('action' => 'categories'));
        }
        $this->Flash->error(__('Unable to update your Category.'));
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}


    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->Category->delete()) {
            $this->Flash->success(__('Category deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Category was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
	
	public function import() {
		$this->layout='backend';
		set_time_limit(0);
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
            $this->Flash->success(__('Your Family has been updated.'));
            return $this->redirect(array('action' => 'families'));
        }
        $this->Flash->error(__('Unable to update your Family.'));
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
            $this->Flash->success(__('Family deleted'));
            return $this->redirect(array('action' => 'families'));
        }
        $this->Flash->error(__('Family was not deleted'));
        return $this->redirect(array('action' => 'families'));
    }
	
	public function view_offers(){
		$this->layout='backend';
	$customer_id= $this->Auth->user('id');	
	$demands=$this->Demand->find('all',array('recursive'=>2,'fields'=>array('familyId','hiddenId'),'conditions'=>array('AND'=>array('Demand.customerId'=>$customer_id),array('Demand.borrado'=>1))));
	$this->set('demands',$demands); //pr($demands);
		
	}

}