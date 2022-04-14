<?php

require('../Gincludes/config.inc.php');
require(MYSQL);
header('Content-type: application/json');

$q = "SELECT * FROM patient_details";
$r = @mysqli_query($dbc, $q);
$newArr = array();
    while ($db_field = mysqli_fetch_assoc($r)) {
        $newArr[] = $db_field;       
    }

    echo json_encode($newArr);

    mysqli_free_result($r);
    mysqli_close($dbc);
   
?>