<?php


class maildb{
    private $pdo;

  function __construct(){

        try{

            $db_user =  "test_eds_web";
            $db_pass="eMM7yg9k.00";
            $db_base="sbsmail";
            $db_dsn='mysql:host=localhost;dbname='.$db_base;
            $opt = array(
                //any occurring errors wil be thrown as PDOException
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // an SQL command to execute when connecting
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
            );
            $this->pdo = new PDO($db_dsn, $db_user, $db_pass, $opt);
        }
        catch(Exception $e){

            echo '<p class="error">Oops, we have encountered a problem, but we will deal with it. </p>';
            mail('arajashekar@email.arizona.edu', 'pdo connection failed on ldap db on sbs', $e->getMessage());
        }

    }

    function getConn(){
        return $this->pdo;
    }





}