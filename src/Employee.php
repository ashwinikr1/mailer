<?php
class Employee extends Person{



    /**
     * @param array $person
     */
    public function __construct($person=array()){
        $this->emplID=$person["emplId"];
        $this->name=$person["name"];
        $this->email=$person["email"];
        $this->department=$person["department"];
        $this->title=$person["title"];
        $this->sbshome=$person["sbshome"];
    }

    public function get_all_employees(){


    }



}