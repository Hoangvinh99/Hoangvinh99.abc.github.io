<?php
session_start();
include("../../role/checkrole/admin.php");
include("../../dbconnector.php");
?>
<html>
	<head>
		<title>Add students</title>
		<script src="../../js/addStudents.js"></script>
	</head>
	<body>
		<table>
			<tr>
				<td>Level:<td>
				<td><div name="any">
					<select name="classLevel" onchange="listClass();listStudent()" required>
						<option value="beginer">Beginer</option>
						<option value="intermediate">Intermediate </option>
						<option value="advanced">Advanced </option>
					</select></div>
				</td>
			</tr>
			<tr>
				<td> Class ID:</td>
				<td>
				<div name="classID"></div>
				</td>
			</tr>
			<tr>
				<td> Add students:</td>
			</tr>
			<tr>
				<td></td>
				<td><div name="studentID"></div></td>
			</tr>
			<tr>
				<td colspan=2></td>
				<td><button onclick="addStudent()">ADD</button></td>
			</tr>
		</table>
		<script>
			listClass();
			listStudent();
		</script>
	</body>
</html>