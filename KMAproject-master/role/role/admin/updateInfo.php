<?php
	session_start();
	include("../../role/checkrole/admin.php");
	
	if(!empty($_GET["class"]) and !empty($_GET["student"])){
		include("../../dbconnector.php");
		$class = $_GET["class"];
		$student = $_GET["student"];
		$sql = "update student set class=? where ID=?";
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("ss", $class,$student);
		$stmt->execute();
		echo "DONE";
	}
	else{
		echo "ERROR";
	}
?>