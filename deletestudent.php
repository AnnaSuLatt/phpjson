<?php  

	$id=$_POST['stu_id'];

	$jsonData=file_get_contents("student.json");
	if ($jsonData) {
		$stu_arr=json_decode($jsonData,true);

		unset($stu_arr[$id]);

		$jsonStr=json_encode($stu_arr,JSON_PRETTY_PRINT);

		file_put_contents("student.json", $jsonStr);

		echo "Success";
	}


?>