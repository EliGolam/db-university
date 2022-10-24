<?php 
  /* Import contants */
  include_once __DIR__ . "./database-constants.php";

  /* CONNECT TO DATABASE */
  $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Verify connection
  if ($conn && $conn->connect_error) {
    echo "<p>Connection Failed: $conn->connect_error</p>"; 
    die();
  }

  echo "<p>Connection OK!</p>";

  // Create Query
  $sql = "SELECT t.name, t.surname, t.id FROM teachers as t WHERE t.id < 10"; 
  $result = $conn->query($sql);

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