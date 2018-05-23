<?php
class Wholesalerlist extends AppModel {
	
	 public $belongsTo = array(
        'Family' => array(
            'className' => 'Family',
            'foreignKey' => 'familyId'
        )
    );
	

}