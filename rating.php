<?php
require('headers.php');
require('functions.php');

/*Tietokantayhteys*/
$db = openDB();
/*SQL haku tietokantaan */
$value = $_GET['value'];
//sanitointi
$value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
//SQL haku tietokantaan
$sql = "CALL TitleByRating($value)";
$prepared = $db->prepare($sql);
$prepared->execute();

$result = $prepared->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
echo $result;