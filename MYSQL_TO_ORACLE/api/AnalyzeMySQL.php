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

$seq_ddl = $MySQLAnalyzer->make_sequence_ddl();

echo $seq_ddl;

$comment_ddl = $MySQLAnalyzer->make_comment_ddl();

print_r($comment_ddl);

$table_ddl = $MySQLAnalyzer->make_table_ddl();

$replace_type_ddl = $MySQLAnalyzer->replace_type($table_ddl);
echo $replace_type_ddl;
?>