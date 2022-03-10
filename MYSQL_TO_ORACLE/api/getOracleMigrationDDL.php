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

$table_ddl = $MySQLAnalyzer->make_table_ddl();

$comment_ddl = $MySQLAnalyzer->make_comment_ddl();

$seq_ddl = $MySQLAnalyzer->make_sequence_ddl();

$synonym_ddl = $MySQLAnalyzer->make_synonym_ddl();

$index_ddl = $MySQLAnalyzer->make_index_ddl($table_ddl);

if($index_ddl != null) {
    $table_ddl = $MySQLAnalyzer -> remove_key_in_ddl($table_ddl);
}

$table_ddl = $MySQLAnalyzer->check_invalid_query_end($table_ddl);

$result = array(
  "TABLE_DDL" => $table_ddl
  , "COMMENT_DDL" => $comment_ddl
  , "SEQ_DDL" => $seq_ddl
  , "SYNONYM_DDL" => $synonym_ddl
  , "INDEX_DDL" => $index_ddl
);

echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>