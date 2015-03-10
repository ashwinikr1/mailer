<?php

include_once("db.php");

function myAutoLoad($classname){

    include "$classname.php";
}

spl_autoload_register("myAutoLoad");


//set default listtype to be shown
$listType="all";
$peopleList=array();

$funcs = new funcs();

/* Get the dept list*/

$department = new department($pdo);
$depts = $department->get_all_depts();
$dept="all";

if(!empty($_GET)){

    if(!empty($_GET["l"])){
      $listType=$funcs->cleanInput($_GET["l"]);

    }

    if(!empty($_GET["dept"]))
         $dept=$funcs->cleanInput($_GET["dept"]);



   switch($listType){

       case 'all':{

            $college = new CollegePeople($pdo);
            $all_faculty_staff = $college->get_all_sbs_faculty_staff($dept);
            $peopleList=$all_faculty_staff;
            break;
       }
       case 'faculty':{
           $college = new CollegePeople($pdo);
           $all_faculty_staff = $college->get_all_faculty($dept);
           $peopleList=$all_faculty_staff;
           break;

       }
       case 'staff':{
           $college = new CollegePeople($pdo);
           $all_staff = $college->get_all_staff($dept);
           $peopleList=$all_staff;
           break;

       }
       case 'ta':{
           $college = new CollegePeople($pdo);
           $all_ta_ra = $college->get_all_ta_ra($dept);
           $peopleList=$all_ta_ra;
           break;

       }
       case 'ug':{
           $college = new CollegePeople($pdo);
           $all_ugs = $college->get_all_ugs($dept);
           $peopleList=$all_ugs;
           break;

       }
       case 'g':{
           $college = new CollegePeople($pdo);
           $all_grads = $college->get_all_grads($dept);
           $peopleList=$all_grads;
           break;

       }


       default:{
           break;
       }
   }/* close switch*/

   /*decide sbshome or not*/
   if($peopleList){

       foreach($peopleList as $row){

           $fundings = explode("||", $row["employeePositionFunding"]);
           foreach($fundings as $f){

               if(array_key_exists($f, $depts)){

                   $row["sbshome"] = 'NotSBSHome';
                   $list2[]=$row;
                   $dept_list2[$row["deptName"]]=$row["deptName"];

               }
           }
       }
   }

   if($_GET["download"] == "excel"){
       $mySimpleList = array();
       $index=1;
       if($peopleList){
           foreach($peopleList as $m){
               $s = array();
               $s["No"] = $index;
               $s["Last Name"] = $m['lname'];
               $s["First Name"] = $m['fname'];

               $s["Email Address"] = $m['email'];
               $mySimpleList [] = $s;

               $index++;

           }

       }
               $funcs->down_excel($mySimpleList);
   }
   else if($_GET["download"] == "csv"){
       $mySimpleList = array();
       $index=1;
       if($peopleList){
           foreach($peopleList as $m){
               $s = array();
               $s["No"] = $index;
               $s["Last Name"] = $m['lname'];
               $s["First Name"] = $m['fname'];

               $s["Email Address"] = $m['email'];
               $mySimpleList [] = $s;

               $index++;

           }

       }

      $funcs->down_csv($mySimpleList);
   }

}


//$list_headings = array("listid","name","email","department","title","sbshome");
//$listIterator = new ListIterator($list_headings, $list);

?>

<?php
include_once("header.php");
?>
	<?php
	if($_SERVER["QUERY_STRING"]){
		$str = "&".$_SERVER["QUERY_STRING"];
	}
	?>
	<div class='clearfix'></div>
    <div >
      <ul class="nav nav-tabs">
        <li <?php echo ($listType=='all'?'class="active"':'');?> ><a href="college.php?l=all&dept=all">SBS Faculty Staff</a></li>
        <li <?php echo ($listType=='faculty'?'class="active"':'');?>><a href="college.php?l=faculty&dept=all">SBS Faculty</a></li>
        <li <?php echo ($listType=='staff'?'class="active"':'');?>><a href="college.php?l=staff&dept=all">SBS Staff</a></li>
        <li <?php echo ($listType=='ta'?'class="active"':'');?>><a href="college.php?l=ta&dept=all">SBS TA/RA</a></li>
          <li <?php echo ($listType=='ug'?'class="active"':'');?>><a href="college.php?l=ug&dept=all">SBS UG</a></li>
             <li <?php echo ($listType=='g'?'class="active"':'');?>><a href="college.php?l=g&dept=all">SBS GRAD</a></li>

      </ul>

    </div>
	<div class='clearfix'></div>
	 <a href='dashboard.php'  class='btn btn-default pull-right'>DashBoard</a>
	<div class='clearfix'></div>

    <div style="padding-top: 0.5em;">
		<form action="?" method='get' id='dept_form'>
		Select Department:
		<select name="dept" id="dept" >
		<option value="">ALL</option>
	      <?php foreach($depts as $d){?>
	           <option value='<?php echo $d['dept']?>' <?php echo ( ($dept == $d['dept'])?'selected':'');?>><?php echo $d["deptName"]?></option>
	      <?php }?>
		</select>
		<input type='hidden' name='l' value='<?php echo $listType?>'/>
	</form>


 <div style="float: right; text-align: right;margin-right:20px;">

	<a href="?download=excel<?php echo $str;?>" target="_blank">Download to excel</a> || <a href="?download=csv<?php echo $str;?>" target="_blank">Download to csv</a>
  </div>
    </div>
 <?php $i=1;?>
    <div id='peoplelist' style='clear:both;'>
    <table id='peopletbl' class='table table-condensed' cellspacing="0" width='100%'>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Title</th>
             <th>SBS Home</th>

        </tr>
        </thead>

        <tbody>
        <?php foreach($peopleList as $people){?>
        <tr>
            <td style='width:2%;'><?php echo $i;?></td>
            <td style='width:20%;'><?php echo $people["fname"]." ".$people["lname"];?></td>
             <td style='width:10%;'><?php echo $people["email"];?></td>

              <td style='width:20%;'><?php echo $people["deptName"];?></td>
               <td style='width:20%;'><?php echo $people["title"];?></td>
                <td style='width: 18%;'><?php echo $people["sbshome"];?></td>
        </tr>
          <?php $i++;?>
        <?php }?>
    </tbody>
    </table>


    </div>




