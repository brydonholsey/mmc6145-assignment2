<?php
//this is the logout page. It destroys cookies

//destroy the cookie
if(isset($_COOKIE['Brydon'])){
  setcookie('Brydon', FALSE, time()-300);
}

//include the header
include('templates/header.php');

//Echo a message
echo "<p>You are now logged out</p>";

//Include the footer
include('templates/footer.php');
 ?>
