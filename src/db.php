<?php

#define('DB_USER', "eds_web");
define('DB_USER', "test_eds_web");

#define('DB_PASS', "34rWf9iK8.33");
define('DB_PASS', "eMM7yg8k.00");
define('DB_BASE', "ldap_ua_eds");
define('DB_DSN', 'mysql:host=sbs.arizona.edu;dbname='.DB_BASE);

$opt = array(
    //any occurring errors wil be thrown as PDOException
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // an SQL command to execute when connecting
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
);


try{

    $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, $opt);

}
catch(Exception $e){

    echo '<p class="error">Oops, we have encountered a problem, but we will deal with it. </p>';
    mail('arajashekar@email.arizona.edu', 'pdo connection failed on ldap db on sbs', $e->getMessage());
}