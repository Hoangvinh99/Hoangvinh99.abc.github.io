<?php
	session_start();
	include("../../role/checkrole/teacher.php");
		include("../../dbconnector.php");
		$return_data = array();
		$sql = "SELECT ID from user where username=?";
		$sql2 = "SELECT * from class where teacherID=?";
		$sql3 = "SELECT * FROM student where class=?";
		$sql4 = "SELECT * FROM point where studentID=?"
	if(isset($_GET["studentID"])){
		$student=$_GET["studentID"];
		$stmt = $conn->prepare($sql4);
		$stmt->bind_param("s",$student);
		$stmt->execute();
		$result = $stmt->get_result();
 		$student=$result->fetch_all(MYSQLI_ASSOC);
		$stmt->close();
	}
	else{
		//GET teacherID from session
		$name = $_SESSION["username"];
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s",$name);
		$stmt->execute();
		$result = $stmt->get_result();
		$teacher_data = $result->fetch_all(MYSQLI_ASSOC);
		$teacherID = $teacher_data[0]["teacherID"];
		$stmt->close();

		//get all class with teacherID
		$stmt = $conn->prepare($sql2);
		$stmt->bind_param("s",$teacherID);
		$stmt->execute();
		$result = $stmt->get_result();
 		$class_data=$result->fetch_all(MYSQLI_ASSOC);
		$stmt->close();

		for($i=0;$i<sizeof($class_data);$i++){
			//get all studentID in class
				$student_data = array();
				$class_id = $class_data[$i]["classID"];
				$stmt = $conn->prepare($sql3);
				$stmt->bind_param("s",$class_id);
				$stmt->execute();
				$result = $stmt->get_result();
				$student = $result->fetch_all(MYSQLI_ASSOC);
				$student_data = array_merge($student_data,$student);
				$pre = array($class_data[$i],$student_data);
				array_push($return_data,$pre);
		}
		echo json_encode(array($return_data));
	}
	
?>
