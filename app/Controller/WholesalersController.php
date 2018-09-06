<?php 

// app/Controller/UsersController.php
App::uses('AppController', 'Controller');
class WholesalersController extends AppController {
	public $helpers  = array('Html', 'Form');
    public $components = array('RequestHandler','Session','Paginator','Csv');
	public $uses= array('Customer','Wholesaler','Category','Family','Wholesalerlist','Demand','Offer','Price');
	 

	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		$this->Auth->allow();
		$email= $this->Auth->user('email'); 
		$this->set('email',$email); 
		ini_set('memory_limit', '-1'); 
		$roles= $this->Auth->user('role');
		$this->set('roles',$roles);	
		$wholeSalerId= $this->Auth->user('id');
		$login_name=$this->Wholesaler->find('first',array('fields'=>array('name'),'conditions'=>array('Wholesaler.hiddenid'=>$wholeSalerId)));
		$this->set('login_name',$login_name);
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

    public function index() {
		$this->layout='backend';
        //$this->User->recursive = 0;
        //$this->set('users', $this->paginate());
    }
	
	public function create_your_lists () {
		$this->layout='backend';
		$allcats=$this->Category->find('all',array('fields'=>array('Category.name','Category.image','Category.id'),'conditions'=>array('Category.visible'=>1)));
		$this->set('allcats',$allcats);		
		//$this->Category->findById($id);	
	 
	 }
	public function category_view($cat_id=null){
		$this->layout='backend';
		$wholesaler_id= $this->Auth->user('id'); 
		$this->set('cat_id',$cat_id);
		$cid=base64_decode($cat_id); 
		$cat_image = $this->Category->findById($cid);
		$this->set('cat_image',$cat_image);
		$families=$this->Family->find('all',array('conditions'=>array('Family.categoryId'=>$cid),
		'fields' => array('Family.id','Family.name')));
		$this->set('families',$families); 
		$array_F = array();
		foreach($families as $dataFamily){
			$array_F[] = $dataFamily['Family']['id'];
		}
		$implode_F = "(".implode(',',$array_F).")";	
		$get_wholesaler_list= $this->Wholesalerlist->query("SELECT *
		FROM `wholesalerlists` AS `Wholesalerlist` LEFT JOIN `families` ON `Wholesalerlist`.`familyId` = `families`.`id` WHERE `Wholesalerlist`.`wholeSalerId` = ".$wholesaler_id."
		AND familyId IN ".$implode_F.""); 
		$this->set('get_wholesaler_list',$get_wholesaler_list); 
		if(empty($get_wholesaler_list)){
		return $this->redirect(array('action' => 'choose_family',$cat_id));	
		}else{
			return true;
		}
	}
	
 	public function choose_family($cat_id=null){
		$this->layout='backend';
		$wholesaler_id= $this->Auth->user('id'); 
		$this->set('cat_id',$cat_id);
		$cid=base64_decode($cat_id); 
		$cat_image = $this->Category->findById($cid);
		$this->set('cat_image',$cat_image);
		$check_family_id=$this->Wholesalerlist->find('list',array('fields'=>array('id','familyId'),'conditions'=>array('Wholesalerlist.wholeSalerId'=>$wholesaler_id)));
		$families=$this->Family->find('all',array('conditions'=>array('AND'=>
		array('Family.categoryId'=>$cid),
		array('Family.id !='=>$check_family_id)
		),'fields' => array('Family.id','Family.name')));
		$this->set('families',$families); 
		
	}
	public function add_wholesaler_list($cat_id=null,$family_id=null){
		$this->layout='backend';
		$catid=base64_decode($cat_id);
	$familyid=base64_decode($family_id);
	$family_name=$this->Family->find('first',array('conditions'=>array('Family.id'=>$familyid)));
	$this->set('family_name',$family_name);
	$category_name=$this->Category->find('first',array('conditions'=>array('Category.id'=>$catid)));
	$this->set('category_name',$category_name);
	//$email= $this->Auth->user('username'); 
	$wholesalerId= $this->Auth->user('id'); 
        if ($this->request->is('post')) {
			$this->request->data['Wholesalerlist']['familyId']=$familyid;
			$this->request->data['Wholesalerlist']['wholeSalerId']=$wholesalerId;
			$this->request->data['Wholesalerlist']['borrado']=1;
            $this->Wholesalerlist->create();
            if ($this->Wholesalerlist->save($this->request->data)) {
                $this->Flash->success(__('Familia guardada'));
				/* $to = "$email";
$subject = "Horecafy - Lista creada por distribuidor";

$message = "
<html>
<body>
<p>Hola, gracias por crear una lista con las familias de productos que comercializas. Esperamos que muy pronto te lleguen solicitudes de oferta por parte de los restauradores.</p>
<p>Gracias por usar Horecafy
</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@horecafy.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers); */
                return $this->redirect(array('action' => 'wholesaler_list'));
            }
            $this->Session->setFlash('Incapaz de salvar familia','error');
        }
	}
		
	public function wholesaler_list(){
		$this->layout='backend';
		$wholesaler_id= $this->Auth->user('id'); 
	$lists=$this->Wholesalerlist->find('all',array('recursive'=>2,'conditions'=>array('AND'=>
	array('Wholesalerlist.wholeSalerId'=>$wholesaler_id,
	'Wholesalerlist.borrado'=>1),
	)));	
	$this->set('lists',$lists); //pr($lists);
		
	}	
	
	public function make_offers(){
		$this->layout='backend';
	$wholesaler_id= $this->Auth->user('id'); 	
	$check_demand=$this->Demand->find('all',array(
	'recursive'=>2,
	'conditions'=>array('AND'=>array('Demand.sentTo'=>$wholesaler_id),array('Demand.borrado'=>0)),
	'fields'=>array("COUNT('sentToWholeSalerList') as requests", 'sentToWholeSalerList','customerId','familyId','hiddenId'),
	'group'=>'Demand.sentToWholeSalerList'
	));
	$this->set('check_demand',$check_demand); //pr($check_demand);	
	
	$allcats=$this->Demand->query("select categories.id, categories.name , categories.image, count(demands.hiddenId) as demandsCount from demands 
	left join families on families.id = demands.familyId
	left join categories on categories.id = families.categoryId
	where demands.sentTo = $wholesaler_id
	group by (families.categoryId)");
	$this->set('allcats',$allcats);	//pr($allcats);
	}
	
	public function view_demand($sentToWholeSalerList=null){
		$this->layout='backend';
	$sentToWholeSalerList_id=base64_decode($sentToWholeSalerList);
	$demand_by=	$this->Demand->find('all',array('recursive'=>2,'conditions'=>array('Demand.sentToWholeSalerList'=>$sentToWholeSalerList_id)));
		$this->set('demand_by',$demand_by); //pr($demand_by);
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
	
	public function submit_offer($dem_id=null){
		$this->layout='backend';
		$d_id=base64_decode($dem_id);
		$visible=1;
	$full_demand=$this->Demand->find('first',array('conditions'=>array('Demand.id'=>$d_id)));
	$this->set('full_demand',$full_demand); 
	$wholesalerid= $this->Auth->user('id'); 
	if ($this->request->is('post')) { 
			$randkey= $this->generatekey();
			$this->request->data['Offer']['id']=$randkey;
			$this->request->data['Offer']['customerId']=$full_demand['Demand']['customerId'];
			$this->request->data['Offer']['demandId']=$full_demand['Demand']['hiddenId'];
			$this->request->data['Offer']['quantyPerMonth']=$full_demand['Demand']['quantyPerMonth'];
			$this->request->data['Offer']['typeOfFormatId']=$full_demand['Demand']['typeOfFormatId'];
			$this->request->data['Offer']['wholeSalerId']=$wholesalerid;
			//pr($this->data); die;
			$this->Demand->updateAll(array('Demand.borrado'=>"'".$visible."'"),array('Demand.hiddenId'=>$full_demand['Demand']['hiddenId']));
            $this->Offer->create();
            if ($this->Offer->save($this->request->data)) {
				
                $this->Session->setFlash('La oferta ha sido enviada al restaurador','success');
                return $this->redirect(array('action' => 'thankyou'));
            }
            $this->Session->setFlash('The offer could not be saved. Please, try again.','error');
        }
		
	}

	public function thankyou(){
		$this->layout='backend';
	}
	
	public function edit_wlist($id = null) {
		$this->layout='backend';
    if (!$id) {
        throw new NotFoundException(__('Invalid List'));
    }

    $post = $this->Wholesalerlist->findById($id);
	$this->set('post',$post);
	$postid=base64_encode($post['Wholesalerlist']['familyId']);
	
    if (!$post) {
        throw new NotFoundException(__('Invalid Family'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->Wholesalerlist->id = $id;
        if ($this->Wholesalerlist->save($this->request->data)) {
            $this->Session->setFlash('Your Wholesalerlist has been updated.','error');
            return $this->redirect(array('action' => 'create_your_lists'));
        }
        $this->Session->setFlash('Unable to update your Family.','error');
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}

	public function delete_wlist($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->Wholesalerlist->id = $id;
        if (!$this->Wholesalerlist->exists()) {
            throw new NotFoundException(__('Invalid wholesalerlist'));
        }
        if ($this->Wholesalerlist->delete()) {
            $this->Session->setFlash('Category wholesalerlist','success');
            return $this->redirect(array('action' => 'create_your_lists'));
        }
        $this->Session->setFlash('Category was not deleted','error');
        return $this->redirect(array('action' => 'index'));
    }
	
	public function impexp_wholesalerlists() {
	$this->layout='backend';
	$conn = mysqli_connect('204.93.216.11','LTNet_fsms','caLC1234@','ltnet_horecafy');
	$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	$allow = null;
         if($this->request->is('post')){ //pr($this->request->data); die;
		

		$filename=$this->request->data["Wholesalerlist"]["file"]["tmp_name"];		

		 if(($this->request->data["Wholesalerlist"]["file"]["size"] > 0) and (in_array($this->request->data["Wholesalerlist"]["file"]["type"],$mimes))) {
		$file = $this->request->data["Wholesalerlist"]['file']['tmp_name'];
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
			mysqli_query($conn , "insert into wholesalerlists (name,image,visible) values('".$value0."','".$value1."','".$value2."')"); 
			
                
		}
		$this->Session->setFlash('Data imported sucessfully!','success');
		return $this->redirect(array('action' => 'impexp_wholesalerlists'));
			 //die;
	         fclose($file);	
		 }else{
			$this->Session->setFlash('Sorry, file/mime type is not allowed','error');
			return $this->redirect(array('action' => 'impexp_wholesalerlists'));
		 }
	}
	
	}
	
	public function list_demands($cat_id=null){
		$this->layout='backend';
	$wholesalerid= $this->Auth->user('id'); 
	$cid=base64_decode($cat_id);
	$catinfo=$this->Category->find('first',array('conditions'=>array('Category.id'=>$cid)));	
	$this->set('catinfo',$catinfo);
	$list_demands=$this->Demand->query("SELECT demands. *,customers.*
	FROM demands
	LEFT JOIN customers ON customers.user_id = demands.customerId
	LEFT JOIN families ON families.id = demands.familyId
	LEFT JOIN categories ON categories.id = families.categoryId
	WHERE demands.sentTo =$wholesalerid
	AND families.categoryId =$cid ");	
	$this->set('list_demands',$list_demands);	//pr($list_demands);
	}

}