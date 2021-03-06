<html lang="en"><head>
	<title> REGISTER </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
	<script type="text/javascript" src="../../vendor/bootstrap.js"></script>
	<script type="text/javascript" src="../../js/register.js"></script>
 	<!-- <script type="text/javascript" src="1.js"></script> -->
	<link rel="stylesheet" href="../../vendor/bootstrap.css">
	<link rel="stylesheet" href="../../vendor/font-awesome.css">
 	<link rel="stylesheet" href="../../css/Register.css">
</head>
	<body>
		<?php
			session_start();
			if(!isset($_SESSION) and !isset($_SESSION["username"]) and !isset($_SESSION["password"]) and !isset($_SESSION["role"])){
				header("Location: http://127.0.0.1/KMA/Login.php");	
			}
			else if ($_SESSION["role"]!="administrator"){
				header("Location: http://127.0.0.1/KMA/Index.php");	
			}
		?>
		<?php 
			$success=0;
			//Database
			if(isset($_POST["identityCard"]) and isset($_POST["day"]) and isset($_POST["year"]) and isset($_POST["month"]) and isset($_POST["fullname"]) and isset($_POST["phonenumber"]) and isset($_POST["gender"]) and isset($_POST["address"]) and isset($_POST["role"]) and isset($_POST["extendValue"])){
				include("../../dbconnector.php");
				$DOB= $_POST["year"]."/".$_POST["month"]."/".$_POST["day"];
				$extendValue= $_POST["extendValue"];
				$username= $_POST["fullname"];
				$password= $_POST["password"];
				$role=$_POST["role"];
				$card=$_POST["identityCard"];
				$phone=$_POST["phonenumber"];
				$gender= $_POST["gender"];

				//Generate id
				$id="";
				switch($role){
					case "student":
						$id.="ST";
						break;
					case "teacher":
						$id.="GV";
						break;
					case "administrator":
						$id.="AD";
						break;
					case "parent":
						$id.="PR";
						break;
					default:
						header("Location: http://127.0.0.1/error.html");
						die();
				}
				$id.=$card;	
				
				//check exist account
				$sql= "SELECT count(id) FROM user where id=?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("s", $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$data = $result->fetch_all(MYSQLI_ASSOC);
				if ($data[0]["count(id)"]!=0){
					echo "<b style='color:red'>User already exist</b>";
					header('http://127.0.0.1/KMA/role/admin/Register.php');
					die();
				}
				else{
					//insert into user db
					$sql= "INSERT INTO user (id, username, password, role) VALUES(?, ?, ?, ?)";
					$stmt = $conn->prepare($sql);
					try{
						$stmt->bind_param("ssss", $id, $username, $password, $role);
						$stmt->execute();
						$success=1;
					}
					catch(Exception $e) {
						die("<h1 style='color:red'>ERROR</h1>");
					}
					$stmt->close();
					
					//insert into parent db
					if ($role=="parent"){
						$sql= "INSERT INTO parent (ID, studentID, phone) VALUES(?, ?, ?)";
						$stmt = $conn->prepare($sql);
						try{
							$stmt->bind_param("sss", $id, $extendValue, $phone);
							$stmt->execute();
							$success=1;
						}
						catch(Exception $e) {
							$success=0;
						}
						$stmt->close();
					}
					
					else if ($role=="student"){
						$sql= "INSERT INTO student (ID, level) VALUES(?, ?)";
						$stmt = $conn->prepare($sql);
						try{
							$stmt->bind_param("ss", $id, $extendValue);
							$stmt->execute();
							$success=1;
						}
						catch(Exception $e) {
							$success=0;
						}
						$stmt->close();
					}
					else if ($role=="teacher"){
						$sql= "INSERT INTO teacher (ID, level) VALUES(?, ?)";
						$stmt = $conn->prepare($sql);
						try{
							$stmt->bind_param("ss", $id, $extendValue);
							$stmt->execute();
							$success=1;
						}
						catch(Exception $e) {
							$success=0;
						}
						$stmt->close();
					}
					if ($success==1){
						echo "<h1 style='color:green'>Create user successful with ID: $id</h1>";
					}
					else{
						echo "h1 style='color:red'>Due to some error user haven't created yet</h1>";
					}
				}
			}
		?> 
	
	<div class="bg" style="background: url('../../images/bg-01.jpg');background-size: cover;">
		<h2 style="text-transform: uppercase;">Register <span style="color: red"> A </span><span style="color: yellow"> B </span><span style="color: green"> C </span></h2>
	</div>

	<div class="form_register">
		<div class="container">
				<form action="#" method="POST">
					  <div class="form-group">
						    <div class="form-group col-md-12">
							      <label for="inputEmail4">Fullname</label>
							      <input type="text" class="form-control input" name="fullname" required >
						    </div>
						    <div class="form-group col-md-12">
							      <label for="inputPassword4">Password</label>
							      <input type="password" class="form-control input" name="password" required >
						    </div>
						    <div class="form-group col-md-12">
							    <label for="inputAddress">Confirm password:</label>
							    <input type="password" class="form-control input" name="repassword" onblur="checkPass()" required  >
						    </div>
						    <div class="form-group col-md-12">
							    <label for="inputAddress2">Identity card: </label>
						    	<input type="text" class="form-control input" name="identityCard" onblur="checkCard()" maxlength=12 required >
						    </div>
					  </div>
					  
					  <div class="form-group">
					  		<label for="inputState" class="col-sm-12">Date of birth</label>
						    <div class="col-sm-12 box">
						    	<div class="form-group col-lg-4 dob">
								      <select name="year" class="form-control">
								        <option  value="">Year</option>
								        <?php 
											for ($i=1950;$i<2300;$i++){
												echo "<option value='$i'>$i</option>";
											}
										?>
								      </select>
							    </div>
							    <div class="form-group col-lg-4 dob">
								      <select name="month" class="form-control">
								        <option value="">Month</option>
								        <?php 
											for ($i=1;$i<13;$i++){
												echo "<option value='$i'>$i</option>";
											}
										?>
								      </select>
							    </div>
							    <div class="form-group col-lg-4 dob">
								      <select name="day" class="form-control">
								        <option value="">Day</option>
								        <?php 
											for ($i=1;$i<32;$i++){
												echo "<option value='$i'>$i</option>";
											}
										?>
										</select>
							    </div>
						    </div>

						    <div class="form-group col-md-12">
							    <label for="inputAddress2">Phone number:</label>
						    	<input type="text" class="form-control input" name="phonenumber" onblur="chekcPhone()" maxlength=11 required >
						    </div>

						    <div class="form-group col-md-12 gender">
							    <label for="inputAddress2" class="col-md-12">Gender: </label>
							    <div class="boxGender">
							    	<label class="radio-inline">
							    	<input type="radio" name="gender" id="inlineRadio1" value="Male"> Male
								    </label>
								    <label class="radio-inline">
								    	<input type="radio" name="gender" id="inlineRadio1" value="Female"> Female
								    </label>
								    <label class="radio-inline">
								    	<input type="radio" name="gender" id="inlineRadio1" value="Other"> Other
								    </label>
							    </div>
							    
						    </div>

							<div class="form-group col-md-12 role">
							    <label for="inputAddress2" class="col-lg-1">Role: </label>
						    	<div class="form-group col-lg-6 dob">
								    <select name="role" onchange="checkRole()">
											<option value="student">Student</option>
											<option value="teacher">Teacher</option>
											<option value="parent">Parent</option>
									</select>
							    </div>
						    </div>
							<div name="extend"></div>
						    <div class="form-group col-md-12">
							    <label for="inputAddress2">Address: </label>
						    	<input type="text" class="form-control input" name="address" onblur="checkCard()" maxlength=12 required >
						    </div>

						    
						    
					  </div>
					 
				  	<button type="submit" class="btn btn-primary col-md-4 push-md-4" value="Register" onclick="fillCheck()">Submit</button>
				</form>
		</div>
	</div>
	<footer>Trung Tâm Tiếng Anh ABC - Học Viện KMA</footer>	
	<script>checkRole()</script>
	</body>
</html>