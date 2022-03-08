<?php

require_once ("../lib/php/class_MySQLAnalyzer.php");

$request = file_get_contents("php://input");
$decodedRequest = json_decode($request);

if($decodedRequest->DDL == null) {
    echo "DDL NOT EXIST";
    exit();
}

echo "DDL :)";

$MySQLAnalyzer = new MySQLAnalyzer($decodedRequest->DDL, $decodedRequest->SCHEMA_NAME);
$MySQLAnalyzer->echo_property();

?>