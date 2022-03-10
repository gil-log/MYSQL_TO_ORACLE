<?php

class MySQLAnalyzer {
    public $ddl;
    public $schema_name;
    public $table_name;

    /**
     * @throws Exception
     */
    function __construct($DDL, $SCHEMA_NAME)
    {
        if(!$DDL) throw new Exception("[ERROR] DDL NOT EXIST");
        $this -> ddl = $DDL;
        if(!$SCHEMA_NAME) throw new Exception("[ERROR] SCHEMA NAME NOT EXIST");
        $this -> schema_name = $SCHEMA_NAME;
        if(!$this->get_table_name()) throw new Exception("[ERROR] TABLE NAME NOT MATCHED");
        $this -> table_name = $this -> get_table_name();
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
        //$pattern_comment = '!\"[^\"]+\"\s[^\,]+COMMENT\s\'([^\']+)\'\,!i';
        $pattern_comment = "!\"([^\"]+)\"[^\"]+COMMENT\s'([^']+)',!i";

        if(preg_match_all($pattern_comment, $temp_ddl, $matches)) {
            return $matches;
        }
        return null;
    }

    function remove_comment_in_ddl($ddl)
    {
        return preg_replace("!\sCOMMENT\s'[^']+'!i", "", $ddl);
    }

    function remove_cascade_update_in_ddl($ddl)
    {
        return preg_replace("!\sON\sUPDATE\sCASCADE!i", "", $ddl);
    }

    function make_sequence_ddl()
    {
        $seq_table_name = preg_replace("!_!i", "", $this->table_name);
        $seq_ddl_head = "CREATE SEQUENCE ";
        $seq_ddl_tail = "SEQ INCREMENT BY 1 START WITH 1;";
        return $seq_ddl_head. $this->schema_name . "." . $seq_table_name . $seq_ddl_tail;
    }

    function make_comment_ddl()
    {
        $comment_ddl_head = "COMMENT ON COLUMN ";
        $comment_ddl_tail = " IS '";
        $comment_ddl = array();
        $matched_comment_list = $this->get_comment_list();
        foreach($matched_comment_list[1] as $key => $value) {
            $temp_comment_ddl_item = $comment_ddl_head . $this->table_name . "." . $matched_comment_list[1][$key] . $comment_ddl_tail . $matched_comment_list[2][$key] . "';";
            $comment_ddl[] = $temp_comment_ddl_item;
        }
        return $comment_ddl;
    }

    function make_table_ddl()
    {
        $remove_comment_ddl = $this->remove_comment_in_ddl($this->ddl);
        return $this->remove_cascade_update_in_ddl($remove_comment_ddl);
    }

    function replace_type($ddl)
    {
        $replace_int_type = preg_replace("!\sint\([^\s]+\)!i", " NUMBER(11)", $ddl);
        $replace_mediumint_type = preg_replace("!\smediumint\([^\s]+\)!i", " NUMBER(11)", $replace_int_type);
        $replace_smallint_type = preg_replace("!\ssmallint\([^\s]+\)!i", " NUMBER(6)", $replace_mediumint_type);
        $replace_tinyint_type = preg_replace("!\stinyint\([^\s]+\)!i", " NUMBER(3)", $replace_smallint_type);

        return $replace_tinyint_type;
    }
}

?>