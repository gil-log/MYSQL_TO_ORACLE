<?php

require_once ("../lib/php/class_MySQLAnalyzer.php");

$request = file_get_contents("php://input");
$decodedRequest = json_decode($request);

if($decodedRequest->DDL == null) {
    echo "DDL NOT EXIST";
    exit();
}

$MySQLAnalyzer = new MySQLAnalyzer($decodedRequest->DDL, $decodedRequest->SCHEMA_NAME);

$match_table_name = $MySQLAnalyzer->get_table_name();
if($match_table_name) {
    echo "WOW";
    echo $match_table_name;
}
$MySQLAnalyzer->get_comment_list();
?>