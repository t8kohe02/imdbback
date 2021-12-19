<?php
require('headers.php');
require('functions.php');
/*Hakee tietokannasta tiedot ja asettaa ne JSON muotoon */
try{
    $db = openDB();
    selectAsJson($db, "SELECT * FROM ruotsalaisia");
}catch(PDOException $e){
    echo '<br>'.$e->getMessage();
}