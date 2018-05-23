<?php
$conn = mysqli_connect('204.93.216.11','LTNet_fsms','caLC1234@','ltnet_horecafy');

if(!empty($_FILES))
{
	if($_FILES['csv']['size'] > 0)
	{
		$file = $_FILES['csv']['tmp_name'];
		$csv = array_map('str_getcsv', file($file));
		
		foreach($csv as $csvs){	
			mysqli_query($conn , "insert into distict_detail (zip_code,distict_name,state_name,taluka) values('".$csvs[0]."','".$csvs[1]."','".$csvs[2]."','".$csvs[3]."')");
		}
	}
}
?>


<form action='#' method='post' enctype="multipart/form-data">
	<input type='file' name='csv' />
	
	<input type='submit' value='upload' />
</form>