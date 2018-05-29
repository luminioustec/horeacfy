<?php
class Wholesalerlist extends AppModel {
	
	 public $belongsTo = array(
        'Family' => array(
            'className' => 'Family',
            'foreignKey' => 'familyId'
        )
    );
	
	public $validate = array(
		'brand' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Marca is required'
            )
        )
	);	
	

}