<?php

require_once ("../lib/php/class_MySQLAnalyzer.php");

$request = file_get_contents("php://input");
$decodedRequest = json_decode($request);

try {
    $MySQLAnalyzer = new MySQLAnalyzer($decodedRequest->DDL, $decodedRequest->SCHEMA_NAME, $decodedRequest->TABLE_COMMENT);
} catch(Exception $e) {
    echo $e->getMessage();
    exit();
}

$result = array(
    "TABLE_DDL" => $table_ddl
, "COMMENT_DDL" => $comment_ddl
, "SEQ_DDL" => $seq_ddl
, "SYNONYM_DDL" => $synonym_ddl
, "INDEX_DDL" => $index_ddl
);
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>