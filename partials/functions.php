<?php

  function printTag(&$text, $tag, $class) {
    $openingTag = "<{$tag} class=\"{$class}\">";
    $closingTag = "</{$tag}>";

    echo $openingTag . $text . $closingTag;
  }

  function printQuery (&$query, $queryNumber) {
    $openingTag = '<details>';
    $closingTag = '</details>';

    $data = $query['data'];

    echo $openingTag;

    printTag($query["query"], 'summary', 'query-title');

    $totalResults = count($data);
    $totalResultsText = "Total Results: {$totalResults}";

    printTag($totalResultsText, 'p', 'total-results');

    switch($queryNumber) {
      case 1: 
        echoQueryResult1($data);
        break;
      case 2: 
        echoQueryResult2($data);
        break;
      case 4: 
        echoQueryResult4($data);
        break;
      case 5: 
        echoQueryResult5($data);
        break;
      case 6: 
        echoQueryResult6($data);
        break;
      default: 
        echoQueryResultDefault($data);
    }

    echo $closingTag;
  }

  function echoQueryResult1(&$data) {
    foreach($data as $result) {
      echo "<p>{$result["name"]} {$result["surname"]} : {$result["date_of_birth"]}</p>";
    }
  }

  function echoQueryResult2(&$data) {
    foreach($data as $result) {
      echo "<p>{$result["name"]} - CFU : {$result["cfu"]}</p>";
    }
  }

  function echoQueryResult4(&$data) {
    foreach($data as $result) {
      echo "<p>{$result["name"]} - Year: {$result["year"]}, {$result["period"]}</p>";
    }
  }

  function echoQueryResult5(&$data) {
    foreach($data as $result) {
      echo "<p>ExamID: {$result["id"]} - DATE: {$result["date"]} AT {$result["hour"]}</p>";
    }
  }

  function echoQueryResult6(&$data) {
    foreach($data as $result) {
      echo "<p>{$result["name"]} - {$result["level"]}</p>";
    }
  }

  function echoQueryResultDefault(&$data) {
    foreach($data as $result) {
      echo "<p>{$result}</p>";
    }
  }


?>