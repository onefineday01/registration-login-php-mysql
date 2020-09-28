<?php include('connection.php');
	session_start();
	$username = "";
	$email = "";
	$admin = 0;
	$active = 0;
	$faults = array();
	$con = connection::db();
	if(isset($_POST['reg_user'])) {
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password1 = mysqli_real_escape_string($con, $_POST['password1']);
		$password2 = mysqli_real_escape_string($con, $_POST['password2']);
		$sql = "SELECT * from USERDATA WHERE email = '$email'";
		$result = mysqli_query($con, $sql);
		$sql = "SELECT * from USERDATA WHERE username = '$username'";
		$result2 = mysqli_query($con, $sql);
		if(empty($username)){
			array_push($faults, "Username is required");
		}
		if(empty($email)){
			array_push($faults, "Email is required");
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($faults, "Invalid email format");
		}
		if(!empty($password1) && ($password1 == $password2)) {
			if (strlen($password1) <= '8') {
			    array_push($faults,"Your Password Must Contain At Least 8 Characters!");
			}
			elseif(!preg_match("#[0-9]+#",$password1)) {
			    array_push($faults,"Your Password Must Contain At Least 1 Number!");
			}
			elseif(!preg_match("#[A-Z]+#",$password1)) {
			    array_push($faults,"Your Password Must Contain At Least 1 Capital Letter!");
			}
			elseif(!preg_match("#[a-z]+#",$password1)) {
			    array_push($faults,"Your Password Must Contain At Least 1 Lowercase Letter!");
			}
		}
		if(empty($password1) || empty($password2)) {
			array_push($faults,"Please Check You've Entered and Confirmed Your Password!");
		}
		if(mysqli_num_rows($result) > 0)
			array_push($faults, "Email already registered");
		if(mysqli_num_rows($result2) > 0)
            		array_push($faults, "username not available");
            
        	if(count($faults) == 0){
			$sql = "INSERT INTO USERDATA (username, email, admin, active, password) VALUES ('$username', '$email', '$admin', '$active', '$password1')";
			mysqli_query($con, $sql);
			header('location: login.php');
		}
	}


	if(isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		
		if(empty($username)){
			array_push($faults, "Username is required");
		}
		if(empty($password)){
			array_push($faults, "Password is required");
		}

		if (count($faults) == 0) {
			$query = "SELECT * FROM userDATA WHERE username='$username' AND password='$password'";
			$results = mysqli_query($con, $query);
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				$sql = "Update userDATA SET active = 1 WHERE username = '{$_SESSION['username']}'";
				mysqli_query($con, $sql);
				$row = mysqli_fetch_assoc($results);
				if($row['admin'] == 0)
					header('location: welcome.php');
				else
					header('location: adminpannel.php');
			}else {
				array_push($faults, "Wrong username/password combination");
			}
		}
	}

?>