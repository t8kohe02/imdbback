<?php
require('headers.php');
require('functions.php');

$search = $_GET['search'];
$search = filter_var($search, FILTER_SANITIZE_STRING);
$db = createDbConnection();

$sql = "SELECT DISTINCT primary_title, genre, start_year FROM titles INNER JOIN title_genres   
ON titles.title_id = title_genres.title_id
WHERE primary_title LIKE '%$search%'
LIMIT 10";

$prepared = $db->prepare($sql);
$prepared -> execute();

$results = $prepared->fetchAll(PDO::FETCH_ASSOC);

$results = json_encode($results);

echo $results;