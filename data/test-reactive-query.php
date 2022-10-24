<?php

  include __DIR__ . "/test-database.php";

  /* SEARCH DATA */

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $stmt = $conn->prepare("SELECT t.id, t.name, t.surname FROM teachers as t WHERE t.id = ?");
  $stmt->bind_param("s", $id);

  $stmt->execute();

  $result = $stmt->get_result();

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

  $conn->close();

?>