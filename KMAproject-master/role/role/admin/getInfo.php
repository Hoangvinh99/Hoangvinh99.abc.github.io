<?php
session_start();
include("../../role/checkrole/admin.php");
include("../../dbconnector.php");
$data=array();
if(isset($_GET["teacherLevel"])){
	$ID=$_GET["teacherLevel"];
	$sql = "SELECT ID FROM teacher WHERE level=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$data1 = $result->fetch_all(MYSQLI_ASSOC);
	$data=array_merge($data,$data1);
	$stmt->close();
}

if(isset($_GET["studentLevel"])){
	$ID=$_GET["studentLevel"];
	$sql = "SELECT ID FROM student WHERE level=? and (class is NULL or class=\"\")";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$data1 = $result->fetch_all(MYSQLI_ASSOC);
	$data=array_merge($data,$data1);
	$stmt->close();
}
if(isset($_GET["classLevel"])){
	$ID=$_GET["classLevel"]."%";
	$sql = "SELECT ID FROM class WHERE id like ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$data1 = $result->fetch_all(MYSQLI_ASSOC);
	$data=array_merge($data,$data1);
	$stmt->close();
}

if(isset($_GET["studentID"])){
	$ID=$_GET["studentID"];
	$sql = "SELECT username FROM user WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $ID);
	$stmt->execute();
	$result = $stmt->get_result();
	$data1 = $result->fetch_all(MYSQLI_ASSOC);
	$data=array_merge($data,$data1);
	$stmt->close();
}
echo json_encode($data);
?>
