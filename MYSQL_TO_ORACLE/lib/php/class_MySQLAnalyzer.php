<?php

class MySQLAnalyzer {
    public $ddl;
    public $schema_name;
    public $table_name;
    public $constraint_ddl;
    public $primary_key;

    function __construct($DDL, $SCHEMA_NAME)
    {
        $this -> ddl = $DDL;
        $this -> schema_name = $SCHEMA_NAME;
    }

    function echo_property()
    {
        echo "DDL : " . $this->ddl . " SCHEMA NAME : " . $this->schema_name;
    }

    function get_table_name()
    {
        $temp_ddl = $this -> ddl;
        $pattern_table = '!TABLE\s\"(.*?)\"\s!i';

        if(preg_match($pattern_table, $temp_ddl, $matches)) {
            return $matches[1];
        }
        return null;
    }

    function get_comment_list()
    {
        $temp_ddl = $this -> ddl;
        $pattern_comment = '!\"[^\"]+\"\s[^\,]+COMMENT\s\'([^\']+)\'\,!i';

        if(preg_match_all($pattern_comment, $temp_ddl, $matches)) {
            echo "WOW";
            print_r($matches);
        }
    }
}

?>