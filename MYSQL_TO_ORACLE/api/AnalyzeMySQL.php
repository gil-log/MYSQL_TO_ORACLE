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

$matched_comment_list = $MySQLAnalyzer->get_comment_list();
if($matched_comment_list) {
    $comment_ddl_head = "COMMENT ON COLUMN ";
    $comment_ddl_tail = " IS '";
    $comment_ddl = array();
    echo "TEST";
    foreach($matched_comment_list[1] as $key => $value) {
        $temp_comment_ddl_item = $comment_ddl_head . $matched_table_name . "." . $matched_comment_list[1][$key] . $comment_ddl_tail . $matched_comment_list[2][$key] . "';";
        $comment_ddl[] = $temp_comment_ddl_item;
    }
    echo json_encode($comment_ddl, JSON_UNESCAPED_UNICODE);
    echo "TEST!!!!";
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
$remove_comment_ddl = $MySQLAnalyzer->remove_comment_in_ddl($MySQLAnalyzer->ddl);

$remove_casecade_update_ddl = $MySQLAnalyzer->remove_cascade_update_in_ddl($remove_comment_ddl);
echo "[REMOVE CASCADE UPDATE DDL] ";
echo $remove_casecade_update_ddl;
?>