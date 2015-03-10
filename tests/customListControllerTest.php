<?php
include_once "src/CustomListController.php";

class customListControllerTest extends PHPUnit_Framework_TestCase{

 private $customListController;

    protected function setUp(){
        $this->customListController= new CustomListController();
    }

    public function listNameProvider(){

        return array(array("test tt")/*,
                     array("test list name"),
                    array("DFSF") ,
                    array( "sd34 w45 ")*/);

    }



/**
 *
 * @dataProvider listNameProvider
 * @param string $listname
 * @covers CustomListController::checkIfListNameIsNotEmpty
 */

    function testcheckIfListNameIsNotEmpty($listname){

           $this->assertTrue($this->customListController->checkIfListNameIsNotEmpty($listname));


    }

    /**
     *
     *
     * @param string $listname
     * @covers CustomListController::checkIfListNameIsNotEmpty
     */

    function testcheckIfListNameIsEmpty(){
        $listname="";
        $this->assertFalse($this->customListController->checkIfListNameIsNotEmpty($listname));


    }
 /**
     *
     * @dataProvider listNameProvider
     * @param string $listname
     * @covers CustomListController::checkIfListNameisNotNull
     *
     */

    function testcheckIfListNameisNotNull($listname){

        $this->assertTrue($this->customListController->checkIfListNameisNotNull($listname));

    }


    /**
     *
     * @dataProvider listNameProvider
     * @param string $listname
     * @covers CustomListController::checkIfListNameisNotNull
     *
     */

    function testcheckIfListNameisNotNullNegative(){
        $listname=null;
        $this->assertFalse($this->customListController->checkIfListNameisNotNull($listname));

    }


    /**
     *
     * @dataProvider listNameProvider
     * @param string $listname
     */

    function testcheckIfListNameIsAtleastTwoCharacters($listname){

        $this->assertTrue($this->customListController->checkIfListNameIsAtleastTwoCharacters($listname));

    }


    /**
     *
     *
     * @param string $listname
     */

    function testcheckIfListNameIsAtleastTwoCharactersNegative(){
        $listname="a";
        $this->assertFalse($this->customListController->checkIfListNameIsAtleastTwoCharacters($listname));

    }


    /**
     *
     * @dataProvider listNameProvider
     * @param string $listname
     */

    function testcheckListNameHasNoSpecialChars($listname){

        $this->assertTrue($this->customListController->checkListNameHasNoSpecialChars($listname));

    }


    /**
     *
     *
     * @param string $listname
     */

    function testcheckListNameHasNoSpecialCharsNegative(){
        $listname="%&&3sfg";
        $this->assertFalse($this->customListController->checkListNameHasNoSpecialChars($listname));

    }


    function testaddListForNullListName(){
        $listname=null;
        $this->assertEquals("List Name cannot be empty",$this->customListController->addList($listname));
    }
    function testaddListForEmptyListName(){
        $listname="";
        $this->assertEquals("Enter a list name",$this->customListController->addList($listname));
    }

    function testaddListForOneCharListName(){
        $listname="a";
        $this->assertEquals("Listname should be atleast of length two characters",$this->customListController->addList($listname));
    }
    function testaddListForSpecialCharListName(){
        $listname="a#@#";
        $this->assertEquals("Listname can have only alphabets,numbers, space and _",$this->customListController->addList($listname));
    }

    function testaddListSave(){
        $listname="test me";
        $this->assertEquals("List added successfully", $this->customListController->addList($listname));
    }

    function testgetAllCustomLists(){
      //  $this->assertNotEmpty($this->customListController->getAllCustomLists(1));

    }

    protected function tearDown(){
    $customListController=null;

    }


}