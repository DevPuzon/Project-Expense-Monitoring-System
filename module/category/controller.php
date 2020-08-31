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
        $cat = new Category();
        $CATTYPE = 'Category';
        $VALUE = $_POST['VALUE'];


        $cat->CATTYPE = $CATTYPE;
        $cat->VALUE = $VALUE;

        $istrue = $cat->create();
        if ($istrue == 1) {
            message("New Category [" . $VALUE . "] has been created successfully!", "success");
            redirect('index.php');

        }

    }

}

function doEdit()
{
    if (isset($_POST['save'])) {

        $cat = new Category();
        $catId = $_POST['CONSTANTID'];
        $VALUE = $_POST['VALUE'];

        $cat->VALUE = $VALUE;

        $istrue = $cat->update($catId);
        if ($istrue == 1) {
            message("Category [" . $VALUE . "] has been updated successfully!", "success");
            redirect('index.php');

        }


    }
}


function doDelete()
{
    if (isset($_POST['delete'])) {

        $cat = new Category();
        $catId = $_POST['CATEGORYID'];

        $istrue = $cat->delete($catId);
        if ($istrue == 1) {
            message("Category  has been deleted successfully!", "success");
            redirect('index.php');

        }


    }
}


?>