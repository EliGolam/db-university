<?php

  include_once __DIR__ . "/test-database.php";

  // Print to verity results
  if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<p>";
      echo "Name: " . $row['name'] . " " . $row['surname'] . " ID: " . $row['id'];
      echo "</p>"; 
    }
  }
  else if ($result) {
    echo "0 Results";
  }
  else {
    echo "Query Error";
  }

?>