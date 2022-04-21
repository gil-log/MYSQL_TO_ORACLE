<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>MySQL to Oracle Migrator</title>
    <script type="text/javascript" src="../lib/js/common.js"></script>
    <style type="text/css">
        #wrapper {
            width: 100%;
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
            <h5> 왼쪽 파란색 영역에 지금까지 누적한 Orcale DDL을 입력 후 추출 버튼 클릭</h5>
        </div>
        <div class="header_left">
            <h2> 추출 대상 </h2>
            <h5> Comment, Synonym, Sequence</h5>
        </div>
    </div>
    <input id="converter" type="button" value="추출" onclick="analyzeDDL()"/>
    <div class="content">
        <div class="left">
            <textarea class="text_area" id="oracle_ddl"></textarea>
        </div>
        <div class="right">
            <textarea class="text_area" id="result_ddl" readonly></textarea>
        </div>
    </div>
    <div id="footer">
        <h5> <strong>swgil@huvenet.com</strong> | <CopyRight>All right is reserved.</CopyRight> </h5>
    </div>
</body>
<script>
    function analyzeDDL() {
        let ddl = document.getElementById("oracle_ddl").value;
        const url = "../api/getExtractionDDL.php";
        const method = "POST";
        const requestData = {
            DDL : ddl,
            SCHEMA_NAME : 'EXTRACTION',
            TABLE_COMMENT : 'EXTRACTION'
        };
        callAjax(url, method, requestData, afterAnalyzeDDL);
    }
    function afterAnalyzeDDL(data) {
        const response = JSON.parse(data);
        const seq_ddl = response.SEQ_DDL;
        const comment_ddl = response.COMMENT_DDL;
        const synonym_ddl = response.SYNONYM_DDL;
        const resultDDLArea = document.getElementById("result_ddl");
        resultDDLArea.value = '';
        if(seq_ddl != null) {
            seq_ddl.forEach(e => {
                resultDDLArea.value += '\n\n' +  e;
            })
        }
        if(comment_ddl != null) {
            comment_ddl.forEach(e => {
                resultDDLArea.value += '\n\n' +  e;
            })
        }
        if(synonym_ddl != null) {
            synonym_ddl.forEach(e => {
                resultDDLArea.value += '\n\n' +  e;
            })
        }
    }
</script>
</html>