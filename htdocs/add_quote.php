<?php

//Adds quotes to SQLiteDatabase
include('templates/header.php');

echo "<h2>Add a quotation</h2>";

//restrict access to administrators only
if(!is_administrator()){
  echo "<h2>Access Denied!</h2>";
  echo "<p class='error'>You do not have permissions to access this page.</p>";

  //include footer template
  include('templates/footer.php');

  exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(!empty($_POST['quote']) && !empty($_POST['source'])){

    //prepare the values for storing
    $quote = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quote'])));
    $source = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['source'])));

    //create the favorite quote
    if(isset($_POST['favorite'])){
      $favorite = 1;
    }else{
      $favorite = 0;
    }

    $query = "INSERT INTO quotes (quote,source,favorite) VALUES ('$quote', '$source', $favorite)";
    mysqli_query($dbc, $query);

    if(mysqli_affected_rows($dbc) == 1){
      //echo a message
      echo "<p>Your quotation has been stored</p>";
    }else{
      echo "<p class='error'>Could not store the quote because: " . mysqli_error($dbc) . "</p>";
      echo "<p>The query being run was: " . $query . "</p>";
    }

    mysqli_close($dbc);
  }else{//failed to enter a quotation or a source
    echo "<p class='error'>Please enter a quotation and a source!<p>";
  }
}//end of if PDOStatement
 ?>

<form action="add_quote.php" method="post">
  <p><label>Quote <textarea name="quote" rows="5" cols="30"></textarea></label></p>
  <p><label>Source <input type="text" name="source"></label></p>
  <p><label>Is this a favorite? <input type="checkbox" name="favorite" value="yes"></label></p>
  <p><input type="submit" name="submit" value="Add This Quote!"></p>
</form>

<?php include('templates/footer.php'); ?>
