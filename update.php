<?php include'connectDB.php';
        $con = connection::db();
        $id = $_GET['uid'];
        if(isset($_POST['update_user'])) {
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
                $pass = mysqli_real_escape_string($con, $_POST['pass']);
		$sql = "SELECT * from USERDATA WHERE email = '$email' WHERE uid != $id";
		$result = mysqli_query($con, $sql);
		$sql = "SELECT * from USERDATA WHERE username = '$username' WHERE uid != $id";
		$result2 = mysqli_query($con, $sql);
		if(empty($username)){
			array_push($faults, "Username is required");
		}
		else if(empty($email)){
			array_push($faults, "Email is required");
		}
		else if(empty($pass)){
			array_push($faults, "Password field is empty");
		}
		else if(mysqli_num_rows($result) > 0)
			array_push($faults, "Email already registered");
		else if(mysqli_num_rows($result2) > 0)
                        array_push($faults, "username not available");
                if(isset($_POST['admin'])) {
                        $admin = 1;
                }
                if(isset($_POST['active'])) {
                        $active = 0;
                }
		if(count($faults) == 0){
			$sql = "UPDATE USERDATA set username = '$username', email = '$email', admin = $admin, active = $active, password = '$pass' WHERE uid = $id";
                        //echo $sql;
                        $res = mysqli_query($con, $sql);
			header('location: adminpannel.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Update User</h2>
    </div>
  
  <form method="post">
      <?php include('faults.php'); ?>
        <div class="input-group">
                <label>Username</label>
                <input type="text" name="username">
        </div>
        <div class="input-group">
                <label>Email</label>
                <input type="email" name="email">
        </div>
        <div class="input-group">
                <label>Password</label>
                <input type="password" name="pass" >
        </div>
        <input type="checkbox" id="admin" name="admin" value = 1>
                <label for="Admin"> Make Admin</label>
        <br>
        <br>
        <input type="checkbox" id="active" name="active" value = 0>
                <label for="Active"> Close his Session</label>
        <br>
        <div class="input-group">
                <button type="submit" class="btn" name="update_user">Update</button>
        </div>
  </form>
</body>
</html>