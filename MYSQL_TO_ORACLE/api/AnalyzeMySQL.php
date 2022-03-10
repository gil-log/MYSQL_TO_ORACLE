<?php

require_once ("../lib/php/class_MySQLAnalyzer.php");

$request = file_get_contents("php://input");
$decodedRequest = json_decode($request);

try {
    $MySQLAnalyzer = new MySQLAnalyzer($decodedRequest->DDL, $decodedRequest->SCHEMA_NAME);
} catch(Exception $e) {
    echo $e->getMessage();
    exit();
}

$matched_table_name = $MySQLAnalyzer->get_table_name();
if($matched_table_name) {
    echo "[TABLE NAME] ";
    echo $matched_table_name;
    echo chr(10);
} else {
    echo "[ERROR] TABLE NAME NOT MATCHED";
    exit();
}

echo chr(10);
echo chr(10);

$table_ddl = $MySQLAnalyzer->make_table_ddl();

echo $table_ddl;


echo chr(10);
echo chr(10);

$comment_ddl = $MySQLAnalyzer->make_comment_ddl();

echo($comment_ddl);


echo chr(10);
echo chr(10);

$seq_ddl = $MySQLAnalyzer->make_sequence_ddl();

echo $seq_ddl;

?>