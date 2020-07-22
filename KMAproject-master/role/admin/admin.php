<?php 
include("./role/checkrole/admin.php");
?>
<html>
	<head>
	</head>
	<body>
		<hr />
		<table>
			<tr>
				<td><button style="height:100px; width:100px" onclick="window.location='./role/admin/Register.php'">Add user</td>
				<td><button style="height:100px; width:100px" onclick="window.location='./role/admin/addClass.php'">Add class</td>
				<td><button style="height:100px; width:100px" onclick="window.location='./role/admin/addStudents.php'">Add students</td>
			</tr>
		</table>
	</body>
</html>