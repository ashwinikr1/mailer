<?php
class CustomList{

        private $conn;

        function __construct($db){
            $this->conn= $db;

        }

        function addNewList($userlist){
            $stmt = $this->conn->prepare("insert into user_lists(list_name,created_on,updated_by,owner) values (:listname,
                :createdon,:updated_by,:owner)");
           $op= $stmt->execute($userlist);
           return $op;

        }

        function getAllCustomLists($userid){

            $stmt = $this->conn->prepare("select * from user_lists where owner=:owner");
            $op=$stmt->execute(array("owner"=>$userid));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}