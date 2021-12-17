<?php
require_once('headers.php');
require_once('functions.php');

$input = json_decode(file_get_contents('php://input'));

$uri = parse_url(filter_input(INPUT_SERVER, 'PATH_INFO'),PHP_URL_PATH);

$parameters = explode('/', $uri);
$phrase = $parameters[1];
try {
    $db = openDB();
    
    $sql = "SELECT DISTINCT primary_title, genre, start_year FROM titles INNER JOIN title_genres   
    ON titles.title_id = title_genres.title_id
    WHERE primary_title LIKE '%$phrase%'
    LIMIT 10";
    selectAsJson($db, $sql);
   
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}
