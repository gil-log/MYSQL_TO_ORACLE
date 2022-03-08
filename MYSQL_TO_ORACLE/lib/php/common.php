<?
    require('test.php');
    require('class_MySQLAnalyzer.php');

    $test_import = new MySQLAnalyzer("CREATE ~~~~~~~~~~", "RENTA2");
    $test_import->echo_property();

?>