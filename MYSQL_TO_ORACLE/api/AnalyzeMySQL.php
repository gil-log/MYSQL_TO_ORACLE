<?php

require_once ("../lib/php/class_MySQLAnalyzer.php");

$request = file_get_contents("php://input");
$decodedRequest = json_decode($request);

if($decodedRequest->DDL == null) {
    echo "DDL NOT EXIST";
    exit();
}

$MySQLAnalyzer = new MySQLAnalyzer($decodedRequest->DDL, $decodedRequest->SCHEMA_NAME);

$matched_table_name = $MySQLAnalyzer->get_table_name();
if($matched_table_name) {
    echo "WOW";
    echo $matched_table_name;
}
$matched_comment_list = $MySQLAnalyzer->get_comment_list();
if($matched_comment_list) {
    echo "COLUMN NAME is";
    foreach($matched_comment_list[1] as $matched_comment) {
        echo "[MATCHED]";
        print_r($matched_comment);
    }
    echo "COMMENT Content is";
    foreach($matched_comment_list[2] as $matched_comment) {
        echo "[MATCHED]";
        print_r($matched_comment);
    }
}
?>