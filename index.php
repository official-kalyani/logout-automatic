<?php

// start session
session_start();

// Include database connectivity
  
include_once('config.php');

if (isset($_SESSION['NAME'])) {
   header("Location:dashboard.php");
   exit();
}

if (isset($_POST['submit'])) {

   $errorMsg = "";
  
   $username = $con->real_escape_string($_POST['username']);
   $password = $con->real_escape_string($_POST['password']);  
  
   if(!empty($username) && !empty($password)){

   $query = "SELECT * FROM admins WHERE username = '$username' AND password ='$password'";
    
   $result = $con->query($query);

   if($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['NAME'] = $row['name'];
      $_SESSION['LAST_ACTIVE_TIME'] = time();
      header("Location:dashboard.php");
      die();
   }

   else{
      $errorMsg = "Username or Password is Invalid";
   }
     
   }else{
      $errorMsg = "Username and Password is required";
   }

}    

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Automatic logout after 10 min of user Inactivity in page using PHP Mysql</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="card text-center" style="padding:20px;">
  <h3>Automatic logout after 10 min of user Inactivity in page using PHP Mysql</h3>
</div><br>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4 col-md-offset-4">
      <?php if (isset($errorMsg)) { ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php echo $errorMsg; ?>
        </div>
      <?php } ?>
      <div class="card">
        <div class="card-body">
          <img class="card-img-top" src="img_avatar1.png" style="width:25%;border-radius:50%;margin-left:110px;">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">  
              <label for="username">Username:</label> 
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">  
              <label for="password">Password:</label> 
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <input type="submit" name="submit" class="btn btn-primary btn-block" value="Login"> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>


