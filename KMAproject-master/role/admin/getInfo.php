<?php
session_start();
include("../../role/checkrole/admin.php");
include("../../dbconnector.php");
if(isset($_GET["teacherLevel"])){
	$ID=$_GET["teacherLevel"];
	$sql = "SELECT ID FROM teacher WHERE level=?";
	$stmt = $conn->prepare($sql); 
	$stmt->bind_param("s", $ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_all(MYSQLI_ASSOC);
	echo json_encode($data);
}

if(isset($_GET["studentLevel"])){
	$ID=$_GET["studentLevel"];
	$sql = "SELECT ID FROM student WHERE level=? and class is NULL";
	$stmt = $conn->prepare($sql); 
	$stmt->bind_param("s", $ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_all(MYSQLI_ASSOC);
	echo json_encode($data);
}
if(isset($_GET["classLevel"])){
	$ID=$_GET["classLevel"]."%";
	$sql = "SELECT ID FROM class WHERE id like ?";
	$stmt = $conn->prepare($sql); 
	$stmt->bind_param("s", $ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_all(MYSQLI_ASSOC);
	echo json_encode($data);
}

?>