<?php //this script connects to the database and creates a table

if($dbc = mysqli_connect('localhost', 'root', 'root', 'database_testing')){
  echo "successful connection";

  $query = 'CREATE TABLE quotes(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    quote TEXT NOT NULL,
    source VARCHAR(100) NOT NULL,
    favorite TINYINT(1) UNSIGNED NOT NULL,
    date_entered TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
  )CHARACTER SET utf8';

  if(@mysqli_query($dbc, $query)){
    echo "<p>The table has been created.</p>";
  }else {
    echo "<p> Could not create the table because: " . mysqli_error($dbc) . "<p>";
    echo "<p> The query being run was " . $query . "<p>";
  }
}else{
  echo "Error";
}
