<?php
require_once("../../include/initialize.php");
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
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
}

function doInsert()
{

    if (isset($_POST['save'])) {

//	//`SUPID`, `SUPCODE`, `SUPNAME`, `SUPTIN`, `SUPADD`, `SUPCONTACT`, `SUPREMARKS`
        $cat = new CashAdvance(); 
        $VALUE = $_POST['VALUE'];
 
        $cat->col_cat = $VALUE;

        $istrue = $cat->create();
         
        if ($istrue == 1) {
            message("New Cash Advance [" . $VALUE . "] has been created successfully!", "success");
            redirect('index.php'); 
        } 
    }

}

function doEdit()
{
    if (isset($_POST['save'])) {

        $cat = new CashAdvance();
        $col_id = $_POST['col_id'];
        $col_cat = $_POST['col_cat'];

        $cat->col_cat = $col_cat;
        // echo $cat->update($col_id);
        $istrue = $cat->update($col_id);
        if ($istrue == 1) {
            message("Category [" . $VALUE . "] has been updated successfully!", "success");
            redirect('index.php');

        }


    }
}


function doDelete()
{
    if (isset($_POST['delete'])) {

        $cat = new CashAdvance();
        $catId = $_POST['CATEGORYID'];

        $istrue = $cat->delete($catId);
        if ($istrue == 1) {
            message("Category  has been deleted successfully!", "success");
            redirect('index.php');

        }


    }
}


?>