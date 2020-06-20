<?php

//view quotes from the database
include('templates/header.php');

echo "<h2>Delete a Quote</h2>";

//restrict access to administrators only
if(!is_administrator()){
  echo "<h2>Access Denied!</h2>";
  echo "<p class='error'>You do not have permissions to access this page.</p>";

  //include footer template
  include('templates/footer.php');

  exit();
}

if(isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0)){

  //Define the query
  $query = "SELECT quote, source, favorite FROM quotes WHERE id={$_GET['id']}";
  if($result = mysqli_query($dbc, $query)){//Run the query
    $row = mysqli_fetch_array($result); //Retrieving the information from the database

    //Make the form
    echo '<form action="delete_quote.php" method="post">
      <p>Are you sure you want to delete this quote?</p>
      <div><blockquote>' . $row['quote'] . '</blockquote>- ' . $row['source'];

      //is this a favorite?
      if($row['favorite'] == 1){
        echo "<strong>Favorite!</strong>";
      }

    echo '</div><input type="hidden" name="id" value="' . $_GET['id'] . '">
    <p><input type="submit" name="submit" value="Delete This Quote!"></p>
    </form>';
  }else{//Couldnt get the information
    echo "<p class='error'>Could not retrieve the quote because: " . mysqli_error($dbc) . "</p>";
    echo "<p>The query being run was: " . $query . "</p>";
  }
}elseif(isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id'] > 0 )){
  //Define the query
  $query = "DELETE FROM quotes WHERE id={$_POST['id']} LIMIT 1";
  $result = mysqli_query($dbc, $query); //Execute the query

  //Report on the results
  if(mysqli_affected_rows($dbc) == 1){
    echo "<p>The quote entry has been deleted</p>";
  }else{
    echo "<p class='error'>Could not delete the quote because " . mysqli_error($dbc) . "</p>";
    echo "<p>The query being run was: " . $query . "</p>";
  }
}else{
  echo "<p class='error'>This page has been accessed in error</p>";
}

mysqli_close($dbc); //close database connection

include('templates/footer.php');

?>
