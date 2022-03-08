<?php

class MySQLAnalyzer {
    public $ddl;
    public $schema_name;

    function __construct($DDL, $SCHEMA_NAME)
    {
        $this -> ddl = $DDL;
        $this -> schema_name = $SCHEMA_NAME;
    }

    function echo_property()
    {
        echo "DDL : " . $this->ddl . " SCHEMA NAME : " . $this->schema_name;
    }
}

?>