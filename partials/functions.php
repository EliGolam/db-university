<?php

  function printTag(&$text, $tag, $class) {
    $openingTag = "<{$tag} class=\"{$class}\">";
    $closingTag = "</{$tag}>";

    echo $openingTag . $text . $closingTag;
  }

  function printQuery (&$query, $queryNumber) {
    $openingTag = '<details>';
    $closingTag = '</details>';

    echo $openingTag;

    printTag($query["query"], 'summary', 'query-title');

    $totalResults = count($query['data']);
    $totalResultsText = "Total Results: {$totalResults}";

    printTag($totalResultsText, 'p', 'total-results');

    switch($queryNumber) {
      case 1: 
        echoQueryResult1($query['data']);
        break;
    }

    echo $closingTag;
  }

  function echoQueryResult1(&$data) {
    foreach($data as $result) {
      echo "<p>{$result["name"]} {$result["surname"]} : {$result["date_of_birth"]}</p>";
    }
  }

?>