<html>
	<head>
		<title>Login site</title>
		<meta charset="UTF-8">
		<script type="text/javascript" src="./js/login.js"></script>
	</head>
	<body>
	<?php		
		include("./dbconnector.php");
		session_start();
		
		$sql = "SELECT password,username FROM user WHERE id=? and role=? limit 1";
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("ss", $id, $role);
				
		if(isset($_SESSION["id"]) and isset($_SESSION["username"]) and isset($_SESSION["password"]) and isset($_SESSION['role'])){
			/* debug: echo "Jump 1";*/
			$id= $_SESSION["id"];
			$password= $_SESSION["password"];
			$role= $_SESSION["role"];
			$stmt->execute();
			$result = $stmt->get_result();
			$data = $result->fetch_all(MYSQLI_ASSOC);
			if (!sizeof($data)){
					echo "<b style='color:red'>Username/password incorrect</b>";
				}
				else{
					if ($data[0]["password"]==$password){
						$_SESSION["username"]=$data[0]["username"];
						$_SESSION["password"]=$password;
						$_SESSION["role"]=$role;
						$_SESSION["id"]=$id;
						header("Location:./index.php");
					}
					else{
						echo "<b style='color:red'>Username/password incorrect</b>";
					}
				}
			$stmt->close();
		}
		else{
			session_destroy();
			session_start();
			if(isset($_POST["id"]) and isset($_POST["password"]) and isset($_POST["role"])){
				/*debug: echo "Jump 2";*/
				$id= $_POST["id"];
				$password= $_POST["password"];
				$role = $_POST["role"];
				$stmt->execute();
				$result = $stmt->get_result();
				$data = $result->fetch_all(MYSQLI_ASSOC);
				if (!sizeof($data)){
					echo "<b style='color:red'>ID/password incorrect</b>";
				}
				else{
					if ($data[0]["password"]==$password){
						$_SESSION["username"]=$data[0]["username"];
						$_SESSION["password"]=$password;
						$_SESSION["id"]=$id;
						$_SESSION["role"]=$role;
						header("Location:./index.php");
					}
					else{
						echo "<b style='color:red'>Username/password incorrect</b>";
					}
				}
				$stmt->close();
			}
		}
		$conn->close();
	?>
	<form method="POST" action="#">
		<table>
			<tr>
				<td>
					ID:
				</td>
				<td>
					<input name="id" type="text">
				</td>
			</tr>
			<tr>
				<td>
					Password:
				</td>
				<td>
					<input name="password" type="password">
				</td>
				<td colspan=3><input type="submit" width=100% height=100% onclick="check()" value="Login"></td>
			</tr>
			<tr>
				<td>
					<select name="role">
						<option value="student" selected>Student</option>
						<option value="parent">Parent</option>
						<option value="teacher">Teacher</option>
						<option value="administrator">Admin</option>
					</select>
				</td>
			</tr>
		</table>
	</form>
	</body>
</html>