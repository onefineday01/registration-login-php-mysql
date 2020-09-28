<?php include('connection.php');
        session_start(); 
        //if user gets to adminpannel without logging in (msg : "You must log in first")
        if (!isset($_SESSION['username'])) {
                $_SESSION['msg'] = "You must log in first";
                header('location: login.php');
        }
        //log out from the session
        if (isset($_GET['logout'])) {
                $sql = "Update USERDATA SET active = 0 WHERE username = '{$_SESSION['username']}'";
                mysqli_query(connection::db(), $sql);
                session_destroy();
                unset($_SESSION['username']);
                header("location: login.php");  	
        }
        
        

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Pannel</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>

<div class="header2">
	<h2>Admin Pannel</h2>
</div>
<div class="content2">
  	
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
                <table  id="usertable">
 
                        <tr>
                                <th> Id </th>
                                <th> Username </th>
                                <th> Email </th>
                                <th> Password </th>
                                <th> Active </th>
                                <th> Admin </th>
                                <th> Update </th>
                                <th> Delete </th>

                        </tr >

                        <?php //include('connection.php');

                                $q = "select * from USERDATA Where username != '{$_SESSION['username']}' AND uid != 1";

                                $query = mysqli_query(connection::db(),$q);

                                while($res = mysqli_fetch_array($query)){
                        ?>
                        <tr>

                                <td> <?php echo $res['uid'];  ?> </td>
                                <td> <?php echo $res['username'];  ?> </td>
                                <td> <?php echo $res['email'];  ?> </td>
                                <td> <?php echo $res['password'];  ?> </td>
                                <td> <?php echo $res['active'];  ?> </td>
                                <td> <?php echo $res['admin'];  ?> </td>
                                <td> <button class="success2 btn"> <a href="update.php?uid=<?php echo $res['uid']; ?>" > Update </a> </button> </td>
                                <td> <button class="error2 btn"> <a href="delete.php?uid=<?php echo $res['uid']; ?>" > Delete </a>  </button> </td>
                                
                        </tr>

                        <?php 
                                }
                        ?>
    	<p> <a href="/welcome.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>