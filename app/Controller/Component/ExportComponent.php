<?php
App::uses('Component', 'Controller');
class ExportComponent extends Component {
/**
 * The calling Controller
 *
 * @var Controller
 */
	public $settings = array();
	public $controller;
	/**
	 * Allows the mapping of preg-compatible regular expressions to public or
	 * private methods in this class, where the array key is a /-delimited regular
	 * expression, and the value is a class method.  Similar to the public functionality of
	 * the findBy* / findAllBy* magic methods.
	 *
	 * @var array
	 * @access public
	 */
	public $defaults = array(
		'length' => 0,
		'delimiter' => ',',
		'enclosure' => '"',
		'escape' => '\\',
		'headers' => true,
		'text' => false,
		'excel_bom' => false,
	);

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
)
	/**
	 * Initiate Csv Behavior
	 *
	 * @param object $model
	 * @param array $config
	 * @return void
	 * @access public
	 */
	public function setup($model, $config = array()) {
		$this->settings[$model->alias] = array_merge($this->defaults, $config);
	}
	
	
/**
 * Starts up ExportComponent for use in the controller
 *
 * @param Controller $controller A reference to the instantiating controller object
 * @return void
 */
	public function startup(Controller $controller) {
		$this->controller = $controller;
	}
	function exportCsv($data, $fileName = '', $maxExecutionSeconds = null, $delimiter = ',', $enclosure = '"') {
		$this->controller->autoRender = false;
		// Flatten each row of the data array
		$flatData = array();
		foreach($data as $numericKey => $row){
			$flatRow = array();
			$this->flattenArray($row, $flatRow);
			$flatData[$numericKey] = $flatRow;
		}
		$headerRow = $this->getKeysForHeaderRow($flatData);
		$flatData = $this->mapAllRowsToHeaderRow($headerRow, $flatData);
		if(!empty($maxExecutionSeconds)){
			ini_set('max_execution_time', $maxExecutionSeconds); //increase max_execution_time if data set is very large
		}
		if(empty($fileName)){
			$fileName = "export_".date("Y-m-d").".csv";
		}
		$csvFile = fopen('php://output', 'w');
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="'.$fileName.'"');
		fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
		foreach ($flatData as $key => $value) {
			fputcsv($csvFile, $value, $delimiter, $enclosure);
		}
		fclose($csvFile);
	}
	public function flattenArray($array, &$flatArray, $parentKeys = ''){
		foreach($array as $key => $value){
			$chainedKey = ($parentKeys !== '')? $parentKeys.'.'.$key : $key;
			if(is_array($value)){
				$this->flattenArray($value, $flatArray, $chainedKey);
			} else {
				$flatArray[$chainedKey] = $value;
			}
		}
	}
	public function getKeysForHeaderRow($data){
		$headerRow = array();
		foreach($data as $key => $value){
			foreach($value as $fieldName => $fieldValue){
				if(array_search($fieldName, $headerRow) === false){
					$headerRow[] = $fieldName;
				}
			}
		}
		return $headerRow;
	}
	public function mapAllRowsToHeaderRow($headerRow, $data){
		$newData = array();
		foreach($data as $intKey => $rowArray){
			foreach($headerRow as $headerKey => $columnName){
				if(!isset($rowArray[$columnName])){
					//$rowArray[$columnName] = '';
					$newData[$intKey][$columnName] = '';
				} else {
					$newData[$intKey][$columnName] = $rowArray[$columnName];
				}
			}
		}
		return $newData;
	}
	public function setup($model, $config = array()) {
		$this->settings[$model->alias] = array_merge($this->defaults, $config);
	}

	/**
	 * Import public function
	 *
	 * @param string $filename path to the file under webroot
	 * @return array of all data from the csv file in [Model][field] format
	 * @author Dean Sofer
	 */
	public function importCsv(&$model, $content, $fields = array(), $options = array()) {
		$options = array_merge($this->defaults, $options);

		if (!$this->_trigger($model, 'beforeImportCsv', array($content, $fields, $options))) {
			return false;
		}

		if ($options['text']) {
			// store the content to a file and reset
			$file = fopen("php://memory", "rw");
			fwrite($file, $content);
			fseek($file, 0);
		} else {
			$file = fopen($content, 'r');
		}

		// open the file
		if ($file) {

			$data = array();

			if (empty($fields)) {
				// read the 1st row as headings
				$fields = fgetcsv($file, $options['length'], $options['delimiter'], $options['enclosure']);
			}
			// Row counter
			$r = 0;
			// read each data row in the file
			while ($row = fgetcsv($file, $options['length'], $options['delimiter'], $options['enclosure'])) {
				// for each header field
				foreach ($fields as $f => $field) {
					if (!isset($row[$f])) {
						$row[$f] = null;
					}
					// get the data field from Model.field
					if (strpos($field,'.')) {
						$keys = explode('.',$field);
						if (isset($keys[2])) {
							$data[$r][$keys[0]][$keys[1]][$keys[2]] = $row[$f];
						} else {
							$data[$r][$keys[0]][$keys[1]] = $row[$f];
						}
					} else {
						$data[$r][$model->alias][$field] = $row[$f];
					}
				}
				$r++;
			}

			// close the file
			fclose($file);

			$this->_trigger($model, 'afterImportCsv', array($data));

			// return the messages
			return $data;
		} else {
			return false;
		}
	}

	/**
	 * Converts a data array into
	 *
	 * @param string $filename
	 * @param string $data
	 * @return void
	 * @author Dean
	 */
	public function exportCsv(&$model, $filename, $data, $options = array()) {
		$options = array_merge($this->defaults, $options);

		if (!$this->_trigger($model, 'beforeExportCsv', array($filename, $data, $options))) {
			return false;
		}

		// open the file
		if ($file = fopen($filename, 'w')) {
			// Add BOM for proper display UTF-8 in EXCEL
			if($options['excel_bom']) {
				fputs($file, chr(239) . chr(187) . chr(191));
			}
			// Iterate through and format data
			$firstRecord = true;
			foreach ($data as $record) {
				$row = array();
				foreach ($record as $model => $fields) {
					// TODO add parsing for HABTM
					foreach ($fields as $field => $value) {
						if (!is_array($value)) {
							if ($firstRecord) {
								$headers[] = $model . '.' . $field;
							}
							$row[] = $value;
						} // TODO due to HABTM potentially being huge, creating an else might not be plausible
					}
				}
				$rows[] = $row;
				$firstRecord = false;
			}

			if ($options['headers']) {
				// write the 1st row as headings
				fputcsv($file, $headers, $options['delimiter'], $options['enclosure']);
			}
			// Row counter
			$r = 0; 
			foreach ($rows as $row) {
				fputcsv($file, $row, $options['delimiter'], $options['enclosure']);
				$r++;
			}

			// close the file
			fclose($file);

			$this->_trigger($model, 'afterExportCsv', array());

			return $r;
		} else {
			return false;
		}
	}
	protected function _trigger(&$model, $callback, $parameters) {
		if (method_exists($model, $callback)) {
			return call_user_func_array(array($model, $callback), $parameters);
		} else {
			return true;
		}
	}
}