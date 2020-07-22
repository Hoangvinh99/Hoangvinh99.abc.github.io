<html>
	<head>
		<title>Index site</title>
	</head>
	<body>
		<?php
			session_start();
			if(!isset($_SESSION) or !isset($_SESSION["username"]) or !isset($_SESSION["password"]) or !isset($_SESSION["role"])){
				header("Location: http://127.0.0.1/KMA/Login.php");	
			}
			else{
				echo "Hello: ".$_SESSION["username"];
			}
		?>
		<button onclick="window.location='./?logout=1'">Log out</button>
		<?php
			$role=$_SESSION["role"];
			if($role=="administrator"){
				include("./role/admin/admin.php");
			}
		?>
		<?php
			if (isset($_GET["logout"])){
				session_destroy();
				session_unset();
				header("Location:./Login.php");
			}
		?>
	</body>
</html>