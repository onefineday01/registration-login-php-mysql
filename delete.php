<?php include('connection.php');
        
        if (isset($_GET['uid'])) {
                $uid = $_GET['uid'];
                $q = " DELETE FROM USERDATA WHERE uid = $uid ";
                echo $q;
                if(mysqli_query(connection::db(), $q))
		{
			header("location : adminpannel.php");
		}
		else
		{
  			echo("Error: $sql".mysqli_error($db));
		}
        }


?>