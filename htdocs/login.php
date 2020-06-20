<?php
//This page lets people log into the Site

//Set two variables with default values
$loggedin = false;
$error = false;

//check if the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  //handle the form
  if(!empty($_POST['email']) && !empty($_POST['password'])){

    if((strtolower($_POST['email']) == 'brydon.holsey@ufl.edu') && ($_POST['password'] == 'BeAtFaRm')){//Correct

      //create a cookie
      setcookie('Brydon', 'Holsey', time()+3600);

      //Indicate they are logged in
      $loggedin = true;
    }else{
      $error = "<p>The submitted email address and password do not match what is on file</p>";
    }
  }else{
    $error = "<p>Please make sure you enter both an email address and a password!</p>";
  }
}

//include the header template
include('templates/header.php');

//echo error if it exists
if($error){
  echo "<p class='error'>$error</p>";
}

//indicate if the user is logged in or show the form
if($loggedin){
  echo "<p>You are now logged in!</p>";
}else{
  echo '<h2>Login Form</h2>
  <form action="login.php" method="post">
  <p><label>Email Address <input type="email" name="email"></label></p>
  <p><label>Password <input type="password" name="password"></label></p>
  <p><input type="submit" name="submit" value="Log In"></p>
  </form>';
}

include('templates/footer.php'); //need the footer
 ?>
