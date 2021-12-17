<?php

require('headers.php');
require('functions.php');

try {
    $db = openDB();
    SelectAsJson($db, 'SELECT T.title_type, COUNT(*)
    FROM Titles AS T
    GROUP BY T.title_type
    ORDER BY T.title_type ASC;');
}
catch (PDOException $pdoex){
    returnError($pdoex);
}

