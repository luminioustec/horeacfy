<?php
class Demand extends AppModel {
	
	 public $belongsTo = array(
        'Family' => array(
            'className' => 'Family',
            'foreignKey' => 'familyId'
        ),
		'User'=>array(
		'className'=>'User',
		'foreignKey' => 'customerId'
		)
    );

	/*public $validate = array(
    'targetPrice' => array(
        'rule' => array('money', 'left'),
        'message' => 'Please supply a valid monetary amount.'
    )
);*/

	

}