<?php
session_start();
include("../../role/checkrole/admin.php");
?>
<html>
	<head>
		<script src="/KMA/js/addClass.js"></script>
	</head>
	<body>
		<form action="#" method="POST">
			<table>
				<tr>
					<td>
						Class level:
					</td>
					<td>
						<select name="classLevel" onchange="checkTeacher();classID();" required>
							<option value="beginer">Beginer</option>
							<option value="intermediate">Intermediate </option>
							<option value="advanced">Advanced </option>
						</select>
					</td>
				</tr>
				<tr name="teacherList">
				</tr>
				<tr>
					<td>
						Start day
					</td>
					<td>
						<input type="date" name="startDay" required />
					</td>
				</tr>
				<tr>
					<td>
						Finish day
					</td>
					<td>
						<input type="date" name="finishDay" required />
					</td>
				</tr>
				<tr>
					<td>
						Schedule:
					</td>
					<td>
						<input name="day[]" type="checkbox" value="2" onclick="change()" />Thứ 2
						<input name="day[]" type="checkbox" value="3" onclick="change()"/>Thứ 3
						<input name="day[]" type="checkbox" value="4" onclick="change()"/>Thứ 4
						<input name="day[]" type="checkbox" value="5" onclick="change()"/>Thứ 5
						<input name="day[]" type="checkbox" value="6" onclick="change()"/>Thứ 6
						<input name="day[]" type="checkbox" value="7" onclick="change()"/>Thứ 7
						<input name="day[]" type="checkbox" value="8" onclick="change()"/>Chủ nhật 
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input type="text" name="classCode" hidden />
						<button type="submit" name="addClass" disabled>Add class</button>
					</td>
					<td></td>
				</tr>
			</table>
		</form>
		<script>
			checkTeacher();
			classID();
		</script>
		
		<?php
			include("../../dbconnector.php");
			if(isset($_POST["classLevel"]) and isset($_POST["teacherID"]) and isset($_POST["startDay"]) and isset($_POST["finishDay"]) and isset($_POST["day"])and isset($_POST["classCode"])){
				$level = $_POST["classLevel"];
				$teacher = $_POST["teacherID"];
				$start = $_POST["startDay"];
				$end = $_POST["finishDay"];
				$code = $_POST["classCode"];
				$day = $_POST["day"];
				$addDay = "";
				for ($i=0;$i<sizeof($day);$i++){
					$addDay.=(string)$day[$i];
				}
				
				$sql= "INSERT INTO class (ID, teacherID, start,	end, schedule) VALUES(?, ?, ?, ?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("sssss", $code, $teacher, $start, $end, $addDay);
				$stmt->execute();
				$stmt->close();
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		?>
		
	</body>
</html>