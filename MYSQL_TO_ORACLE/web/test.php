<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>MySQL to Oracle Migratior</title>
    <style type="text/css">
        #wrapper{
            width: 980px;
            margin: 0px auto;
            padding: 20px;
            border-style: dotted;
            border-radius: 20px;
            border: 1px solid #828282;
        }
        #header{
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #828282;
        }
        #footer{
            clear: both;
            border-style: groove;
            margin: 0px 5px;
            background-color: #fff;
            color: black;
            text-align: center;
            border: 1px solid #828282;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <h2> Header</h2>
        <h5>
        <? php
            $test_arr = array(
                'A' => 'a1'
                , 'B' => 'b1'
            );
            foreach($test_arr as $test) {
                echo $test . "<br/>";
            }

            phpinfo();
        ?>
        </h5>
    </div>
    <div id="footer">
        <h5> <strong>swgil@huvenet.com</strong> | <CopyRight>All right is reserved.</CopyRight> </h5>
    </div>
</body>
</html>