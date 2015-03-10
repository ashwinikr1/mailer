<?php

require_once("funcs.php");
require_once("maildb.php");
require_once("CustomList.php");
class CustomListController{
    private $customList;
    function __construct(){
        $maildb=new maildb();
        $db=$maildb->getConn();
        $this->customList = new CustomList($db);
    }

    function addList($listname){

        $message ="";


        if(!$this->checkIfListNameisNotNull($listname)){
            return "List Name cannot be empty";

        }

        if(!$this->checkIfListNameIsNotEmpty($listname)){
            return "Enter a list name";
        }

        if(!$this->checkIfListNameIsAtleastTwoCharacters($listname)){
            return "Listname should be atleast of length two characters";
        }

        if(!$this->checkListNameHasNoSpecialChars($listname)){
            return "Listname can have only alphabets,numbers, space and _";
        }
          $funcs = new funcs();
          $listname = $funcs->cleaninput($listname);



          $userlist = array();
          $userlist["listname"]=$listname;
          $userlist["owner"]=1;
          $userlist["updated_by"]=1;
          $userlist["createdon"]=date("Y-m-d H:i:s" ,time());
          //add new list
          $op = $this->addNewList($userlist);

          if(!$op)
              return $op;
          else
              return "List added successfully";


    }

    function addNewList($userlist){

        $op =  $this->customList->addNewList($userlist);
        return $op;
    }

    function uploadList(){
        $listname= $_POST["list_name"];
        $uploadedlist = $_FILES["uploadlist"];


                if($_FILES["uploadlist"]["type"] != "text/csv"){
                    return "FileType not allowed. Upload a csv file";
                }

                //get the info from csv
                $uploadedfile = fopen($_FILES["uploadlist"]["tmp_name"],"r");
                while(!feof($uploadedfile))
                     {
                        echo "<pre>";
                        print_r(fgetcsv($uploadedfile));
                        echo "</pre>";
                     }
                fclose($uploadedfile);
    }


    function getAllCustomLists($userid){
        $alllists =  $this->customList->getAllCustomLists($userid);

        return $alllists;
    }


    function checkIfListNameisNotNull($listname){
            if($listname === null){
                return false;
            }
            return true;
    }


    function checkIfListNameIsNotEmpty($listname){

        if(empty($listname)){
            return false;
        }
        return true;
    }

    function checkIfListNameIsAtleastTwoCharacters($listname){
        if(strlen($listname) < 2){
            return false;
        }
        return true;
    }


    function checkListNameHasNoSpecialChars($listname){
        $specialchars = preg_match("/^[a-z1-9A-Z_ ]*$/", $listname);
        if(!$specialchars){
            return false;
        }
        return true;
    }

}