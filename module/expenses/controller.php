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

 
	}
   
	function doInsert(){
	
	if (isset($_POST['save'])) {
		
		$defaults = new Defaults();
		$item		= $_POST['item'];
		$default  	= $_POST['default'];
		$category 	= $_POST['category'];

		$COMMONCODE	= $category.$item;
		//$res = $defaults->find_all_default($COMMONCODE);
			global $mydb;
			$mydb->setQuery("SELECT count(*) as Noresult
							FROM  tblcommonmaster 
							WHERE  `COMMONCODE` = '".$COMMONCODE."'");
			$cur = $mydb->loadSingleResult();
			$Noresult =  $cur->Noresult;
			//$res = $mydb->num_rows($cur);//get the number of count
			//echo $Noresult;

		if ($Noresult >=1) {
			message("Default already exist!","error");
			redirect('index.php');
		}else{
			$defaults->COMMONCODE  = $COMMONCODE;
			$defaults->CATEGORY 	= $category;
			$defaults->LISTNAME 	= $item;
			$defaults->IS_DEFAULT    = $default;
			
			 $istrue = $defaults->create(); 
			 if ($istrue == 1){
			 
			 	message("New Expense [". $item ."] has been created successfully!","success");
				redirect('index.php');

			 }
	}	 

		
	
	}

	}

	function doEdit(){
		global $mydb;
		if (isset($_POST['save'] )) {
			
			$defaults = new Defaults();
			$dftid		= $_POST['dftid'];
			$item		= $_POST['item'];
			$default  	= $_POST['default'];
			$category 	= $_POST['category'];
		
			/*if($default=="YES"){
			 $mydb->InsertThis("UPDATE `tblcommonmaster` SET `IS_DEFAULT` = 'NO' WHERE CATEGORY='{$category}' AND IS_DEFAULT='YES' ");
			 }*/
			$COMMONCODE	= $category.$item;
			
				$defaults->COMMON_CODE  = $COMMONCODE;
				$defaults->CATEGORY 	= $category;
				$defaults->LISTNAME 	= $item;
				$defaults->IS_DEFAULT    = $default;
				$defaults->updatedefaults($dftid);
				
				 	message("Expense [". $item ."] has been updated successfully!","success");
					redirect('index.php');

		}


	}


	function doDelete(){
		
		
		$id = 	$_GET['id'];

		$dept = new Defaults();
		$dept->delete($id);

			 
		message("Default has been Deleted!","info");
		redirect('index.php');
		// }
		// }

		//5/
	}

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photos/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photos/" . $myfile);
		 	
					 

						$user = New User();
						$user->USERIMAGE 			= $location;
						$user->update($_SESSION['USERID']);
						redirect("index.php");
						 
							
					}
			}
			 
		}
 
?>