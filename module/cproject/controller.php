<?php
require_once ("../../include/initialize.php");
	  if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;

	case 'default':
	doInsertdefault();
	break;
	
	case 'addexpenses' :
	doInsertExpenses();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'loadexp' :
	LoadExpenses();
	break;

	case 'loadexpSum' :
	LoadExpensesSummary();
	break;

	case 'singleproj' :
	fetchsingleProject();
	
	case 'editAmount':
	editAmount();
	break;
	case 'addAmount':
	addAmount();
	break;
 
	}

	function sumProjExp($projectID = 0){
			$Projectexp = new Project();
       		$RES =   $Projectexp->sumProjectExpenses($projectID);
       		$Projectexp->PROJECTEXPENSES = $RES->expenses;
       		$Projectexp->updateproject($projectID);

	}

	function addAmount(){
		if (isset($_POST['save'])) {
			$Expenses = new Expenses();
			$EXPID 	  = $_POST['expid'];
			$PROJECTID = $_POST['pid'];
			$EXPENSES = $_POST['expenses'];


			$Expenses->EXPENSES = $EXPENSES;
		$istrue = $Expenses->updateExpenses($EXPID );
		if ($istrue == 1) {
 		sumProjExp($PROJECTID);
			
			message("Expenses has been updated!","success");
	   		redirect("index.php?view=view&id=".$PROJECTID);
		}
		}
	}
   
     
   function doInsertdefault(){
   		if (isset($_GET['id'])){
   		$projectID = $_GET['id'];
   		$EXPITEM 	= 'N/A';
   		$SUPPLIER 	= 'N/A';
   		$DATEGIVEN 	= strftime("%Y-%m-%d", time());
   		$DATEADDED 	= strftime("%Y-%m-%d", time());
   		$EXPENSAMOUNT 	= 0;
   		$REQUESTEDBY 	= $_SESSION['ACCOUNT_NAME'];
   		$ENCODER 	=  $_SESSION['ACCOUNT_NAME'];
   		$EMPID 		=  $_SESSION['ACCOUNT_ID'];

   		global $mydb;
   		$query = "INSERT INTO tblexpenses (PROJECTID, `EXPTYPE`, EXPITEM, SUPPLIER, DATEGIVEN, DATEADDED, EXPENSES, REQUESTEDBY, ENCODER, EMPID) SELECT '". $projectID."', `LISTNAME`, '". $EXPITEM."','". $SUPPLIER."','". $DATEGIVEN."','". $DATEADDED."','". $EXPENSAMOUNT."','". $REQUESTEDBY."','". $ENCODER."','". $EMPID."' FROM `tblcommonmaster` WHERE `CATEGORY` = 'Expenses' AND IS_DEFAULT ='YES' AND LISTNAME NOT IN (SELECT `EXPTYPE` FROM tblexpenses WHERE `PROJECTID` =". $projectID.")";
	   		$istrue = $mydb->InsertThis($query);
	   		
	   		if ($istrue == 1) {
	   			message("All defaults has been addedd!","success");
	   			redirect("index.php");

	   		}

   		}
   }
   function fetchsingleProject(){

   	 @$projectID = $_SESSION['id'];
	  $Project = New Project();
	  $sProject = $Project->single_project($projectID);
	  				 $cost = $sProject->PROJECTCOST;
                      $exp  = $sProject->PROJECTEXPENSES;
                      $remFund = $cost - $exp;
		$output = '<tr>
                 
                      <td><strong>Project Name</strong></td><td>'. $sProject->PROJECTNAME .'
                      <tr>
                      <td><strong>Start Date </strong></td><td>'. $sProject->STARTDATE .'
                      <tr>
                      <td><strong>End Date </strong></td><td>'. $sProject->ENDDATE .'
                      <tr>
                      <td><strong>Project Cost</strong></td><td>'. $sProject->PROJECTCOST .'
                      <tr>
                      <td><strong>Total Expenses</strong></td><td>'. $sProject->PROJECTEXPENSES .'
                       <tr>
                      <td><strong>Available Funds</strong></td><td>'. $remFund .'<br/>
                      <tr>
                      <td><strong>Project Status</strong></td><td>'. $sProject->PROJECTSTATUS .'
                     
                    </tr>';
		echo json_encode($output);
   }



   function doInsertExpenses(){
   	if (isset($_POST['save'])){
//`EXPID`, `PROJECTID`, `EXPITEM`, `SUPPLIER`, `DATEGIVEN`, `DATEADDED`, `EXPENSES`, `REQUESTEDBY`, `ENCODER`, `EMPID`
   //		echo "ara";
/*if ($_POST['action'] == 'addexpenses') {
	echo "Ara tood";
}else{
	echo "wala gd";
}*/
  		$Expenses = new Expenses();
   		$PROJECTID 	= $_POST['PROJECTID'];
   		$EXPTYPE 	= $_POST['exptype'];
   		$EXPITEM 	= $_POST['itemname'];
   		$SUPPLIER 	= $_POST['Supplier'];
   		$DATEGIVEN 	= $_POST['dategiven'];
   		$DATEADDED 	= strftime("%Y-%m-%d", time());
   		$EXPENSAMOUNT 	= $_POST['Amount'];
   		$REQUESTEDBY 	= $_POST['REQUESTEDBY'];
   		$ENCODER 	=  $_SESSION['ACCOUNT_NAME'];
   		$EMPID 		=  $_SESSION['ACCOUNT_ID'];

   		$Expenses->PROJECTID = $PROJECTID;
   		$Expenses->EXPTYPE = $EXPTYPE;
   		$Expenses->EXPITEM = $EXPITEM;
   		$Expenses->SUPPLIER = $SUPPLIER;
   		$Expenses->DATEGIVEN = $DATEGIVEN;
   		$Expenses->DATEADDED = $DATEADDED;
   		$Expenses->EXPENSES = $EXPENSAMOUNT;
   		$Expenses->REQUESTEDBY = $REQUESTEDBY;
   		$Expenses->ENCODER = $ENCODER;
   		$Expenses->EMPID = $EMPID;

   		 $istrue = $Expenses->create(); 
		 if ($istrue == 1){
		 	sumProjExp($PROJECTID);
			fetchsingleProject();
		 }
/*
   	}else{
   		//LoadExpenses();
   		echo "wala";*/
   	}
   }

   	function LoadExpenses(){
		global $mydb;
		$query = "";
   		$output = array();
   		if (isset($_SESSION['id'])) {
   			$query .= "SELECT * FROM `tblexpenses` WHERE PROJECTID =".$_SESSION['id']." ";
   			if(isset($_POST["search"]["value"]))
			{
				$query .= '	AND EXPTYPE LIKE "%'.$_POST["search"]["value"].'%" ';
			}
   			
   		}else{
   			$query .= "SELECT * FROM `tblexpenses` ";
   			if(isset($_POST["search"]["value"]))
			{
				$query .= 'OR EXPTYPE LIKE "%'.$_POST["search"]["value"].'%" ';
			}
   		}
		
   		$mydb->setQuery($query);
   		$cur = $mydb->loadResultList();
		$data = array();
		$filtered_rows = $mydb->num_rows();
		$i = 1;	
		foreach ($cur as $result) {
					 
		$sub_array = array();
			
			$sub_array[] = $i;
			$sub_array[] = $result->EXPTYPE;
			$sub_array[] = $result->EXPITEM;
			$sub_array[] = $result->SUPPLIER;

				if ($result->EXPENSES == 0) {
					$sub_array[] = '<a class="btn btn-warning btn-sm" href="index.php?view=addAmount&id='.$result->EXPID.'" >'.$result->EXPENSES.'</a>';
				}else{
					$sub_array[] = $result->EXPENSES;
				}
			$sub_array[] = $result->REQUESTEDBY;
			$sub_array[] = $result->DATEADDED;
			$sub_array[] = $result->ENCODER;
			$data[] = $sub_array;
		$i = $i + 1;		
		}
		function get_total_all_records()
		{
			global $mydb;
			$statement = "SELECT * FROM `tblexpenses` WHERE PROJECTID =".$_SESSION['id']."";
			$mydb->setQuery($statement);
			return $mydb->num_rows();
		}

		$output = array('data' 			   => $data, 
						"recordsTotal"	   => $filtered_rows,
						"recordsFiltered"	=>	get_total_all_records() );
		echo json_encode($output);

}
function LoadExpensesSummary(){


		global $mydb;
		$expsumQuery = "";
   		$expSumoutput = array();
   		if (isset($_SESSION['id'])) {
   			$expsumQuery .= "SELECT `EXPTYPE`, SUM(`EXPENSES`) as expenses FROM `tblexpenses` WHERE PROJECTID =".$_SESSION['id']." GROUP BY `EXPTYPE ";
   			
   		}
   		
		
   		$mydb->setQuery($expsumQuery);
   		$curexp = $mydb->loadResultList();
		$dataexp = array();
		$filtered_rowsexp = $mydb->num_rows();
		$i = 1;	
		foreach ($curexp as $result) {
					 
		$sub_arrayexp = array();
			
			$sub_arrayexp[] = $i;
			$sub_arrayexp[] = $result->EXPTYPE;
			$sub_arrayexp[] = $result->expenses;
			$dataexp[] = $sub_arrayexp;
		$i = $i + 1;		
		}
		function get_total_all_recordsexp()
		{
			global $mydb;
			$statementexp = "SELECT `EXPTYPE`, SUM(`EXPENSES`) as expenses FROM `tblexpenses` WHERE PROJECTID =".$_SESSION['id']." GROUP BY `EXPTYPE ";
			$mydb->setQuery($statementexp);
			return $mydb->num_rows();
		}

		$expSumoutput = array('data' 	  => $dataexp, 
						"recordsTotal"	   => $filtered_rowsexp,
						"recordsFiltered"	=>	get_total_all_recordsexp() );
		echo json_encode($expSumoutput);

 

}


	function doInsert(){
	
	if (isset($_POST['save'])){
		
// `PROJECTID`, `PROJECTNAME`, `STARTDATE`, `ENDDATE`, ``, `PROJECTCOST`, `PROJECTSTATUS`
		$Project = new Project();
		$PROJECTNAME	= $_POST['projectname'];
		$STARTDATE   	= $_POST['startdate'];
		$ENDDATE 		= $_POST['enddate'];
		$PROJECTCOST 	= $_POST['projectcost'];
		$PROJECTSTATUS 	= $_POST['status'];

		
				$Project->PROJECTNAME 	= $PROJECTNAME;
				$Project->STARTDATE 	= $STARTDATE;
				$Project->ENDDATE 		= $ENDDATE;
				$Project->PROJECTCOST 	= $PROJECTCOST;
				$Project->PROJECTSTATUS = $PROJECTSTATUS;
				
				 $istrue = $Project->create(); 
				 if ($istrue == 1){
				 	message("New Project [". $PROJECTNAME ."] has been created successfully!", "success");
				 	redirect('index.php');
				 	
				 }
				
		}

	}

	function doEdit(){
	if (isset($_POST['save'])){
		
		$Project = new Project();
		$PROJECTID		= $_POST['PROJECTID'];
		$PROJECTNAME	= $_POST['projectname'];
		$STARTDATE   	= $_POST['startdate'];
		$ENDDATE 		= $_POST['enddate'];
		$PROJECTCOST 	= $_POST['projectcost'];
		$PROJECTSTATUS 	= $_POST['status'];

		
				$Project->PROJECTNAME 	= $PROJECTNAME;
				$Project->STARTDATE 	= $STARTDATE;
				$Project->ENDDATE 		= $ENDDATE;
				$Project->PROJECTCOST 	= $PROJECTCOST;
				$Project->PROJECTSTATUS = $PROJECTSTATUS;
				//$Project->PROJECTID 	= $PROJECTID;
				
				 $istrue = $Project->updateproject($PROJECTID); 
				 if ($istrue == 1){
				 	message("[". $PROJECTNAME ."] project has been updated successfully!", "success");
				 	redirect('index.php');
				 	
				 }else{
				 	message("[". $PROJECTNAME ."] project has not been updated successfully!", "error");
				 	redirect('index.php');
				 }
				
		
		}
	}


	
 
?>