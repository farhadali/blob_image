<?php
require_once "db.php";
	

if(isset($_POST['id'])){
	$id =  $_POST['id'];
	$user  = $_POST['user'];
	$full_name  = $_POST['full_name'];
	$mobile  = $_POST['mobile'];
	$email  = $_POST['email'];
	$password  = md5($_POST['password']);
	$active  = $_POST['active'];
	$base64_data= $_POST['photo'];
	
	$sql = "UPDATE users SET  `user`='$user',`full_name`='$full_name',`mobile`='$mobile',`email`='$email',`active`='$active', ";
		if($_POST['password'] !=''){
			$sql .=	" `password`='$password', ";
		}
		if($_POST['photo'] !=''){
			$imgData =addslashes(file_get_contents($base64_data));
			$sql .="`photo`='$imgData', ";
		}	
		$sql .= " `full_name`='$full_name' where `id`=".$id."";
		$current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on  Insert<br/>" . mysqli_error($conn));
		if(isset($current_id)) {
			header("Location: list.php");
		}

}else{
	$user  = $_POST['user'];
	$full_name  = $_POST['full_name'];
	$mobile  = $_POST['mobile'];
	$email  = $_POST['email'];
	$password  = md5($_POST['password']);
	$active  = $_POST['active'];
	$base64_data= $_POST['photo'];
	$imgData =addslashes(file_get_contents($base64_data));
	$sql = "INSERT INTO users(user,full_name,mobile,email,password,active,photo)
		VALUES('{$user}', '{$full_name}','{$mobile}','{$email}','{$password}','{$active}','{$imgData}')";
		$current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on  Insert<br/>" . mysqli_error($conn));
		if(isset($current_id)) {
			header("Location: list.php");
		}
}








?>