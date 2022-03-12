<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>MySQL to Oracle Migratior</title>
 
</head>
<body>
<div id="wrapper">
    <div id="header">
        <h2> Header</h2>
        <h5>
        <?php
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
