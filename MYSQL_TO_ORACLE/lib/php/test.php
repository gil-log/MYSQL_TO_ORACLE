<?php

class Test {
    function __construct()
    {
        $this->test_php();
    }

    function test_php()
    {
        echo "TEST PHP";
    }
}

$test = new Test();
$test->test_php();

?>