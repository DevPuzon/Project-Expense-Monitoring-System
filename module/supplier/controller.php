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
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}
   
	function doInsert(){
	
	if (isset($_POST['save'])){
		
//	//`SUPID`, `SUPCODE`, `SUPNAME`, `SUPTIN`, `SUPADD`, `SUPCONTACT`, `SUPREMARKS`
		$Supplier = new Supplier();
		$SUPCODE		= $_POST['SUPCODE'];
		$SUPNAME   		= $_POST['SUPNAME'];
		$SUPTIN 		= $_POST['SUPTIN'];
		$SUPADD 		= $_POST['SUPADD'];
		$SUPCONTACT 	= $_POST['SUPCONTACT'];
		$SUPREMARKS 	= $_POST['SUPREMARKS'];

		
				$Supplier->SUPCODE 	  = $SUPCODE;
				$Supplier->SUPNAME 	  = $SUPNAME;
				$Supplier->SUPTIN 	  = $SUPTIN;
				$Supplier->SUPADD 	  = $SUPADD;
				$Supplier->SUPCONTACT = $SUPCONTACT;
				$Supplier->SUPREMARKS = $SUPREMARKS;
				
				 $istrue = $Supplier->create(); 
				 if ($istrue == 1){
				 	message("New Supplier [". $SUPNAME ."] has been created successfully!", "success");
				 	redirect('index.php');
				 	
				 }
				
		}

	}

	function doEdit(){
	if (isset($_POST['save'])){
		
		$Supplier = new Supplier();
		$SUPID			= $_POST['SUPID'];
		$SUPCODE		= $_POST['SUPCODE'];
		$SUPNAME   		= $_POST['SUPNAME'];
		$SUPTIN 		= $_POST['SUPTIN'];
		$SUPADD 		= $_POST['SUPADD'];
		$SUPCONTACT 	= $_POST['SUPCONTACT'];
		$SUPREMARKS 	= $_POST['SUPREMARKS'];

		
			//	$Supplier->SUPCODE 	  = $SUPCODE;
				$Supplier->SUPNAME 	  = $SUPNAME;
				$Supplier->SUPTIN 	  = $SUPTIN;
				$Supplier->SUPADD 	  = $SUPADD;
				$Supplier->SUPCONTACT = $SUPCONTACT;
				$Supplier->SUPREMARKS = $SUPREMARKS;
				
				 $istrue = $Supplier->updateSupplier($SUPID); 
				 if ($istrue == 1){
				 	message("Supplier [". $SUPNAME ."] has been updated successfully!", "success");
				 	redirect('index.php');
				 	
				 }
					
		
		}
	}


	function doDelete(){
	}

	
 
?>