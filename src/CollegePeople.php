<?php
class CollegePeople{
    private $conn=null;

    function __construct($db){
        $this->conn=$db;

    }

    function get_all_sbs_faculty_staff($department){
        $where_dept="";
        $restricts=array("primaryAffiliation"=>"student");

       if(isset($department) && ($department != "all")){
            $where_dept = " and (deptName = :deptName) ";
            $where_dept = " and (dept = :deptNo) ";
            $restricts['deptNo']=$department;
        }
        $stmt = $this->conn->prepare("SELECT netid, lname, fname, email, title, phone, roomNum, buildingNum, email, deptName, dept,".
            " orgReport, etype, affiliation, primaryAffiliation, employeePositionFunding, '' sbshome from eds_employees where ".
	    "((( orgReport like '%SBSC%'  ) and primaryAffiliation <> :primaryAffiliation)) $where_dept order by fname, lname, email");
        //*need to add  $where_add_fac people outside sbs*/
        $stmt->execute($restricts);
        $data = $stmt->fetchAll();

        return $data;

    }

    function get_all_faculty($department){
        try{
            $where_dept="";

        $where = " and title not like :title1 and title not like :title2 and title not like :title3 and (primaryAffiliation = :primaryAffiliation or (affiliation LIKE :affiliation and primaryAffiliation = :primaryAffiliation2)) ";
        $restricts = array(":title1"=>"%Lecturer%", ":title2"=>"%Adjunct%", ":title3"=>"%Instructor%", ":primaryAffiliation"=>"faculty", ":affiliation"=>"%|faculty|%", ":primaryAffiliation2"=>"staff");

        //dept filter
        if(isset($department) && ($department != "all")){
            $where_dept = " and (deptName = :deptName) ";
            $where_dept = " and (dept = :deptNo) ";
            $restricts['deptNo']=$department;
        }

        $faculty_current = ' id="active"';
        //*need to add  $where_add_fac people outside sbs */
        $stmt = $this->conn->prepare("SELECT netid, lname, fname, email, title, phone, roomNum, buildingNum, email, deptName, dept, orgReport, etype, affiliation, primaryAffiliation, employeePositionFunding, '' sbshome from eds_employees where ".
            "((( orgReport like '%SBSC%'  ) $where ) ) $where_dept order by fname, lname, email");


        $stmt->execute($restricts);
        $data = $stmt->fetchAll();
        }catch(PDOException $pe){
            var_dump($pe);
        }
        return $data;
    }


    function get_all_staff($department){
        try{

        $where_dept="";
        $restricts=array();
        if(isset($department) && ($department != "all")){
          //  $where_dept = " and (deptName = :deptName) ";
            $where_dept = " and (dept = :deptNo) ";
            $restricts['deptNo']=$department;
        }


        $where = " and primaryAffiliation = :primaryAffiliation ";
        $restricts["primaryAffiliation"] = "staff";

        $where_add_staff = $add_staff;
        $stmt = $this->conn->prepare("SELECT netid, lname, fname, email, title, phone, roomNum, buildingNum, email, deptName, dept, orgReport, etype, affiliation, primaryAffiliation, employeePositionFunding, '' sbshome from eds_employees where ".
            "((( orgReport like '%SBSC%'  ) $where ) ) $where_dept order by fname,lname, email");




        $stmt->execute($restricts);
        $data = $stmt->fetchAll();
        }catch(PDOException $pe){
            var_dump($pe);
        }
        return $data;
    }


    function get_all_ta_ra($department){
        try{
            $restricts = array(":affiliation"=>"%|gradasst|%");

            $where_dept="";


             if(isset($department) && ($department != "all")){
              //  $where_dept = " and (deptName = :deptName) ";
                $where_dept = " and (dept = :deptNo) ";
                $restricts['deptNo']=$department;
            }

            $where = " and affiliation LIKE :affiliation ";

            //$skip_nonsbs = ' and 1=0 ';

            $stmt = $this->conn->prepare("SELECT netid, lname, fname, email, title, phone, roomNum, buildingNum, email, deptName, dept, orgReport, etype, affiliation, primaryAffiliation, employeePositionFunding, '' sbshome from eds_employees where ".
                "((( orgReport like '%SBSC%'  ) $where ) ) $where_dept $skip_nonsbs order by  fname,lname, email");

            $stmt->execute($restricts);
            $data = $stmt->fetchAll();
            }catch(PDOException $pe){
                var_dump($pe);
            }
            return $data;
}


function get_all_ugs($department){
    try{
        //$restricts = array(":affiliation"=>"%|gradasst|%");

        $where_dept="";


        if(isset($department) && ($department != "all")){
            //  $where_dept = " and (deptName = :deptName) ";
            $where_dept = " and (dept = :deptNo) ";
            $restricts['deptNo']=$department;
        }

        $where = " and career='UGRD' ";
//$where_dept
        //$skip_nonsbs = ' and 1=0 ';

        $stmt = $this->conn->prepare("SELECT netid, lname, fname, email,career,studentAPDesc,major,residency,level_value  from eds_grads join aca_levels al on eds_grads.level=al.level_key where ".
            " college ='USBSC'  $where   order by fname, lname, email");


        $stmt->execute();
        $data = $stmt->fetchAll();
    }catch(PDOException $pe){
        var_dump($pe);
    }
    return $data;
}


function get_all_grads($department){
    try{
        //$restricts = array(":affiliation"=>"%|gradasst|%");

        $where_dept="";


        if(isset($department) && ($department != "all")){
            //  $where_dept = " and (deptName = :deptName) ";
            $where_dept = " and (dept = :deptNo) ";
            $restricts['deptNo']=$department;
        }

        $where = " and career='GRAD' ";

        //$skip_nonsbs = ' and 1=0 ';

        $stmt = $this->conn->prepare("SELECT netid, lname, fname, email,level_value,career, studentAPDesc,major,residency  from eds_grads  join aca_levels al on eds_grads.level=al.level_key where  career='GRAD' and college in ('GDEG','GCRT') order by lname, fname, email");

        $stmt->execute();
        $data = $stmt->fetchAll();

    }catch(PDOException $pe){
        var_dump($pe);
    }
    return $data;
}

}