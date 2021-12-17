<?php
//luo ja palauttaa tietokantayhteyden
Function openDB(){
    $db = new PDO('mysql:host=localhost;dbname=imdb', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

//Hakuja varten kysely kantaan, haku muutetaan JSONiksi
function SelectAsJson(object $db, string $sql): void{
    $query = $db->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($results);
}

function returnError(PDOException $pdoex): void {
    header('HTTP/1.1 500 internal server error');
    $error = array('error' => $pdoex->getMessage());
    echo json_encode($error);
    exit;
}