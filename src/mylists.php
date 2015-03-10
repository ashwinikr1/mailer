<?php
session_start();
/*error_reporting(E_ALL);
ini_set("display_errors","on");*/


require("CustomListController.php");

$all_lists=array();
$user_id=1;
$customListController = new CustomListController();

if(!empty($_POST)){


    $listname = $_POST["listname"];

    if(isset($_POST['save'])){

       $op = $customListController->addList($listname);

        if($op !== false){
            $message= $op;
        }

    }else if (isset($_POST['upload_list'])){

        if(isset($_FILES["uploadlist"])){

            $op = $customListController->uploadList();

        }
    }


}

//get all the custom lists of this user
$all_lists = $customListController->getAllCustomLists($user_id);
?>


<?php include "header.php";?>


<div class='container-fluid'>
<div class=''>
   <a href='dashboard.php'  class='btn btn-default'>DashBoard</a>
   <button class='btn btn-default pull-right add_new_list'>Add New List</button>
   <button class='btn btn-default pull-right upload_new_list'>Upload List</button>
</div>
<div class='clearfix'></div>

<div class='error'>
<?php echo (isset($message)?$message:"");?>
</div>

<form method='post' enctype='multipart/form-data'>
<div class='newlist'>
<div class='form-group newlist'>

<label for="listname">List Name</label>
    <input type="text" class="form-control" id="listname" name = 'listname' placeholder="Enter List Name">

</div>

 <input type="submit" class="btn btn-default" name='save' value='Save'/>
</div>
<div class='uploadlist'>

<div class='form-group'>

    <label for="list_name">List Name</label>
    <input type="text" class="form-control" id="list_name" name='list_name' placeholder="Enter List Name">

</div>

<div class='form-group'>

    <label for="uploadlist">Upload csv</label>
    <input type="file" class="form-control" id="file" name='uploadlist' placeholder="Select File">

</div>

 <input type="submit" class="btn btn-default" name='upload_list' value='Save'/>
</div>

</form>

<div id='mylists' class='col-md-12'>
    <table class='table'>
    <thead>
        <tr>
            <td>#</td>
            <td>List Name</td>
            <td>Created On</td>
            <td>Last Updated By</td>
            <th>Owner</th>
        </tr>
    </thead>
<?php $i=1;?>
    <?php foreach($all_lists as $m){?>
            <tr>
                <td><?php echo $i++;?></td>
                <td><?php echo $m['list_name']?></td>
                <td><?php echo $m['created_on']?></td>
                <td><?php echo $m["updated_by"]?></td>
                <td><?php echo $m["owner"]?></td>
            </tr>

    <?php }?>
  </table>

</div>

</div>
