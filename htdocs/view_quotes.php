<?php

//view quotes from the database
include('templates/header.php');

echo "<h2>View Quotes</h2>";

//restrict access to administrators only
if(!is_administrator()){
  echo "<h2>Access Denied!</h2>";
  echo "<p class='error'>You do not have permissions to access this page.</p>";

  //include footer template
  include('templates/footer.php');

  exit();
}

//define a $query
$query = "SELECT id, quote, source, favorite FROM quotes ORDER BY date_entered DESC";

//run the query
if($results = mysqli_query($dbc, $query)){

  //retrieve the returned records
  while($row = mysqli_fetch_array($results)){
    //echo the quote
    echo "<div><blockquote>{$row['quote']}<blockquote>-{$row['source']}\n";

    //is this a favorite?
    if($row['favorite'] == 1){
      echo "<strong>Favorite!</strong>";
    }
    //Add administrative links
    echo "<p>Quote Admin: <a href='edit_quote.php?id={$row["id"]}\'>Edit</a>
    <a href='delete_quote.php?id={$row["id"]}\'>Delete</a></p></div>";
  }//while loop end
}else{//query did not run
  echo "<p class='error'>Could not retriece the data because: " . mysqli_error($dbc) . "</p>";
  echo "<p>The query being run was: " . $query . "</p>";
}//End of query if statement

mysqli_close($dbc);

include('templates/footer.php');

 ?>
