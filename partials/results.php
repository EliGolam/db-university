<?php 
  /* Parsing Json Files  */

  $jsonRawData = file_get_contents("results/query1.json");
  $results[] = json_decode($jsonRawData, true); // True to indicate associative arrays

  $jsonRawData = file_get_contents("results/query2.json");
  $results[] = json_decode($jsonRawData, true); 

  $jsonRawData = file_get_contents("results/query3.json");
  $results[] = json_decode($jsonRawData, true); 

  $jsonRawData = file_get_contents("results/query4.json");
  $results[] = json_decode($jsonRawData, true); 

  $jsonRawData = file_get_contents("results/query5.json");
  $results[] = json_decode($jsonRawData, true); 

  $jsonRawData = file_get_contents("results/query6.json");
  $results[] = json_decode($jsonRawData, true); 

  $jsonRawData = file_get_contents("results/query7.json");
  $results[] = json_decode($jsonRawData, true); 

  $jsonRawData = file_get_contents("results/query8.json");
  $results[] = json_decode($jsonRawData, true); 

?>