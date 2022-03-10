<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>MySQL to Oracle Migrator</title>
    <script type="text/javascript" src="../lib/js/common.js"></script>
    <style type="text/css">
        #wrapper {
            width: 980px;
            margin: 0px auto;
            padding: 20px;
            border-style: dotted;
            border-radius: 20px;
            border: 1px solid #828282;
        }
        #header {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #828282;
            display: flex;
        }
        .header_left {
            margin-left: 10px;
        }
        #footer {
            clear: both;
            border-style: groove;
            margin: 0px 5px;
            background-color: #fff;
            color: black;
            text-align: center;
            border: 1px solid #828282;
        }
        .content {
            display: flex;
            width: 100%;
            height: 500px;
            clear: both;
            border-style: groove;
            background-color: #fff;
            color: black;
            text-align: center;
            border: 1px solid #828282;
            margin-bottom: 10px;
        }
        .content .left {
            background: cornflowerblue;
            width: 50%;
            height: 100%;
        }
        .content .right {
            background: lightcoral;
            width: 50%;
            height: 100%;
        }
        .text_area {
            width: 90%;
            height: 90%;
            margin-top: 10px;
        }
        #converter {
            width: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div>
            <h2> 사용법 </h2>
            <h5> 왼쪽 파란색 영역에 MySQL DDL을 입력 후 컨버팅 버튼 클릭시 Oracle용 DDL 생성</h5>
        </div>
        <div class="header_left">
            <h2> 컨버팅 대상 </h2>
            <h5> Comment, Data Type, Enum, PK, FK, Synonym, Sequence, Index</h5>
        </div>
    </div>
    <span>스키마 명 : </span><input id="schema_name" type="text" value="RENTA2"/>
    <span>테이블 설명 : </span><input id="table_comment" type="text" value=""/>
    <input id="converter" type="button" value="컨버팅" onclick="convert()"/>
    <div class="content">
        <div class="left">
            <textarea class="text_area" id="mysql_ddl"></textarea>
        </div>
        <div class="right">
            <textarea class="text_area" id="oracle_ddl" readonly></textarea>
        </div>
    </div>
    <div id="footer">
        <h5> <strong>swgil@huvenet.com</strong> | <CopyRight>All right is reserved.</CopyRight> </h5>
    </div>
</body>
<script>
function convert() {
    analyzeMysql();
}
function analyzeMysql() {
    let mysql_ddl = document.getElementById("mysql_ddl").value;
    console.log(mysql_ddl);
    let schema_name = document.getElementById("schema_name").value;
    console.log(schema_name);
    let table_comment = document.getElementById("table_comment").value;
    const url = "../api/getOracleMigrationDDL.php";
    const method = "POST";
    const requestData = {
        DDL : mysql_ddl,
        SCHEMA_NAME : schema_name,
        TABLE_COMMENT : table_comment
    };
    console.log(requestData);
    callAjax(url, method, requestData, test);
}
function test(data) {
    console.log("----------");
    console.log(data);
    console.log("----------");
    const response = JSON.parse(data);
    const table_ddl = response.TABLE_DDL;
    const seq_ddl = response.SEQ_DDL;
    const index_ddl = response.INDEX_DDL;
    const comment_ddl = response.COMMENT_DDL;
    const synonym_ddl = response.SYNONYM_DDL;
    const oracleDDLArea = document.getElementById("oracle_ddl");
    oracleDDLArea.value = table_ddl;
    oracleDDLArea.value += '\n\n' +  seq_ddl;
    oracleDDLArea.value += '\n\n' +  index_ddl;
    oracleDDLArea.value += '\n\n' +  comment_ddl;
    oracleDDLArea.value += '\n\n' +  synonym_ddl;

}
function test_page(response) {
    alert(response);
}
</script>
</html>