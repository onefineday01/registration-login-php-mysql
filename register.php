<?php include('connectDB.php') ;?>
<!DOCTYPE html>
<html>
<head>
    <title>SignUp</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>
    <div class="header">
        <h2>Register</h2>
    </div>
  
  <form method="post" action="register.php">
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
          <input type="password" name="password1" >
      </div>
      <div class="input-group">
          <label>Confirm password</label>
          <input type="password" name="password2" >
      </div>
      <div class="input-group">
          <button type="submit" class="btn" name="reg_user">Register</button>
      </div>
      <p>
        Already a member? <a href="/login.php">Sign in</a>
      </p>
  </form>
</body>
</html>