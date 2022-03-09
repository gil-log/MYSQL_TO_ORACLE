<?php

require_once ("../lib/php/class_MySQLAnalyzer.php");

$request = file_get_contents("php://input");
$decodedRequest = json_decode($request);

if($decodedRequest->DDL == null) {
    echo "[ERROR] DDL NOT EXIST";
    exit();
}

if($decodedRequest->SCHEMA_NAME == null) {
    echo "[ERROR] SCHEMA NAME NOT EXIST";
    exit();
}

$MySQLAnalyzer = new MySQLAnalyzer($decodedRequest->DDL, $decodedRequest->SCHEMA_NAME);

$matched_table_name = $MySQLAnalyzer->get_table_name();
if($matched_table_name) {
    echo "[TABLE NAME] ";
    echo $matched_table_name;
    echo chr(10);
} else {
    echo "[ERROR] TABLE NAME NOT MATCHED";
    exit();
}
$matched_comment_list = $MySQLAnalyzer->get_comment_list();
if($matched_comment_list) {
    echo "[COLUMN NAME] ";
    echo chr(10);
    echo "-----------";
    foreach($matched_comment_list[1] as $matched_comment) {
        print_r($matched_comment);
    }
    echo "-----------";
    echo "[COMMENT] ";
    echo chr(10);
    echo "-----------";
    foreach($matched_comment_list[2] as $matched_comment) {
        print_r($matched_comment);
    }
    echo "-----------";
}
?>