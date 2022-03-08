<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>MySQL to Oracle Migratior</title>
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
        <h2> 사용법 </h2>
        <h5> 왼쪽 파란색 영역에 MySQL DDL을 입력 후 컨버팅 버튼 클릭시 Oracle용 DDL 생성</h5>
    </div>
    <span>스키마 명 : </span><input id="schema_name" type="text" value="RENTA2"></input>
    <input id="converter" type="button" value="컨버팅" onclick="test()"></input>
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
function test() {
    alert("test");
}
</script>
</html>