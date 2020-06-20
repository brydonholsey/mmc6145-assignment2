<?php
// This file defines custom functions




/*--------------------------------

This function checks to see if user is administrator.
This function takes two optional values
This function returns Boolean value

----------------------------------*/
function is_administrator($name = 'Brydon', $value = 'Holsey'){

  //check for the cookie and check its value
  if(isset($_COOKIE[$name]) && ($_COOKIE[$name] == $value)){
    return true;
  }else{
    return false;
  }
}//ends the is_administrator() function


//Connect variable
$dbc = mysqli_connect('localhost', 'root', 'root', 'database_testing');


 ?>
