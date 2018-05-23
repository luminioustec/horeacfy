<?php
class Family extends AppModel {
	
 public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'categoryId'
        )
    );

}