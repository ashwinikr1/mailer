<?php
class Person{

    private $emplID;
    private $name;
    private $email;
    private $department;
    private $title;
    private $sbshome;
    private $college;
    private $personType;/*faculty,staff,student,studentworker*/


    private function __construct($person=array()){
        $this->emplID=$person["emplId"];
        $this->name=$person["name"];
        $this->email=$person["email"];
        $this->department=$person["department"];
        $this->title=$person["title"];
        $this->sbshome=$person["sbshome"];
    }

}