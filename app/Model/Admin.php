<?php 

class Admin extends AppModel { 

function exportCSV($where = NULL, $delimeter = ',')
{ 
	$csv = ''; 
	$this->recursive = -1; 
	$rows = $this->findAll($where); 
	foreach($rows as $row)
	{ 
		$row[$this->name] = str_replace('"\"', '"\\"', 
		$row[$this->name]); 
		$row[$this->name] = str_replace($delimeter, '"\"' . 
		$delimeter, $row[$this->name]); 
		$csv .= implode($delimeter, $row[$this->name]) . chr(13); 
	} 
 
	$csv = trim($csv); 
	return $csv;
}
 
// Imports CSV 
function importCSV($csv, $delimeter = ',')
{
	$keys = $this->getFieldNames();
	$rows = array(); 
	$csv = trim($csv); 
	$csv_rows = explode(chr(13), $csv); 
 
	foreach($csv_rows as $csv_row)
	{ 
		$csv_row = str_replace('"\\"', '"\"', $csv_row); 
		$csv_row = str_replace('"\"' . $delimeter, chr(26), $csv_row);
		$row = explode($delimeter, $csv_row); 
		$row = str_replace(chr(26), $delimeter, $row); 
		$row = array_combine($keys, $row); 
		$rows = array_merge_recursive($rows, 
		array(array($this->name => $row))); 
	} 
 
	return $rows; 
} 
 
// Returns model fieldnames 
function getFieldNames()
{ 
 
	$names = array(); 
	$fields = $this->_schema;
 
	foreach($fields as $key => $value)
		array_push($names, $key);
 
	return $names;
} 



}