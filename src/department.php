<?php
class department{

    private $conn;
    function __construct($db){
        $this->conn=$db;

    }

    function get_all_depts(){

        try{
            $ps = $this->conn->prepare("select dept, deptName from sbs_depts order by deptName");
            $ps->execute();
            $departments = $ps->fetchAll(PDO::FETCH_ASSOC);
            return $departments;
        }
        catch(Exception $e){
            echo 'problem';
        }

    }
}