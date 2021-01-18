<?php  
	
	$id=$_POST['id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$gender=$_POST['gender'];
	$address=$_POST['address'];
	$old_photo=$_POST['old_photo'];
	$profile=$_FILES['profile'];
	// var_dump($profile);

	if ($profile['size'] > 0) {
		$basepath="photo/";
		$fullpath=$basepath.$profile['name'];
		move_uploaded_file($profile['tmp_name'], $fullpath);
	}else{
		$fullpath=$old_photo;
	}

	$student=[
		"name"=>$name,
		"email"=>$email,
		"gender"=>$gender,
		"address"=>$address,
		"profile"=>$fullpath
	];

	$jsonData=file_get_contents('student.json');
	if ($jsonData) {
		$data_arr=json_decode($jsonData,true);

		$data_arr[$id]=$student;

		$jsonStr=json_encode($data_arr,JSON_PRETTY_PRINT);

		file_put_contents('student.json', $jsonStr);

		header("location:index.php");

	}



?>