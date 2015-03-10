<?php

class funcs{


    function __construct(){

    }

    public function down_csv( $data){

        $filename = "sbslist"."_" . date('Ymd-His') . ".csv";

        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".$filename);
        header("Pragma: no-cache");
        header("Expires: 0");

        $flag = false;
        foreach($data as $row) {
            if(!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            array_walk($row,array($this, 'cleanData'));
            echo implode("\t", array_values($row)) . "\r\n";
        }
        exit;
    }
    public function down_excel( $data){

        $filename = "sbslist"."_" . date('Ymd-His') . ".xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$filename);
        header("Content-Transfer-Encoding: BINARY");
        header("Pragma: no-cache");
        header("Expires: 0");

        $flag = false;
        foreach($data as $row) {
            if(!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            array_walk($row, array($this,'cleanData'));
            echo implode("\t", array_values($row)) . "\r\n";
        }
        exit;
    }
    public function cleanData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        return $str;
    }

    function cleanInput(&$str){
        return $str;
    }
}
