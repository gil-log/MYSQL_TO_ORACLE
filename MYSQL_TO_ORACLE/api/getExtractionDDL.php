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

$comment_ddl = $MySQLAnalyzer->extractCommentDDL();

$seq_ddl = $MySQLAnalyzer->extractSequenceDDL();

$synonym_ddl = $MySQLAnalyzer->extractSynonymDDL();

$result = array(
"COMMENT_DDL" => $comment_ddl
, "SEQ_DDL" => $seq_ddl
, "SYNONYM_DDL" => $synonym_ddl
);
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>