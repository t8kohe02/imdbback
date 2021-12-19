<?php
require('headers.php');
require('functions.php');
/*Hakee tietokannasta tiedot ja asettaa ne JSON muotoon */
try{
    $db = openDB();
    $sql = "SELECT * FROM suomalaisia";
    selectAsJson($db, $sql);
}catch(PDOException $e){
    echo '<br>'.$e->getMessage();
}