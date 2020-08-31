<?php
 
require_once("../../include/initialize.php");
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}
error_reporting(0);
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

        $areas = New Area();
        $Project = new Project();
        $PROJECTID = $_POST['PROJECTID'];
        $LOT_NO = $_POST['LOT_NO'];
        $BLOCK_NO = $_POST['BLOCK_NO'];
        $TOTAL_EXPENSES = $_POST['TOTAL_EXPENSES'];

        $areas->PROJECTID = $PROJECTID;
        $areas->LOT_NO = $LOT_NO;
        $areas->BLOCK_NO = $BLOCK_NO;
        $areas->TOTAL_EXPENSES = $TOTAL_EXPENSES;
        $istrue = $areas->create();


        global $mydb;
        $statementexp = "SELECT * FROM `tblproject` WHERE PROJECTID =" . $PROJECTID . "";
        $mydb->setQuery($statementexp);
        $cur = $mydb->loadResultList();
        foreach ($cur as $r) {
            $Project->PROJECTEXPENSES = $r->PROJECTEXPENSES - $TOTAL_EXPENSES;
            $Project->updateproject($PROJECTID);
        }


        global $mydb;
        $statementexp = "SELECT AREAID FROM tblareas  ORDER BY  AREAID DESC LIMIT 1";
        $mydb->setQuery($statementexp);
        $cur = $mydb->loadResultList();
        foreach ($cur as $r) {
            $AREAID = $r->AREAID;
        }


        $item_c = count($_POST['CATEGORY']);
        for ($i = 0; $i < $item_c; $i++) {
            $newarea = 'area' . $i;
            $newarea = New Area();
            $newarea->AREAID = $AREAID;
            $CATEGORY = $_POST['CATEGORY'][$i];
            $SCOPE_OF_WORK = $_POST['SCOPE_OF_WORK'][$i];
            $PCS = $_POST['PCS'][$i];
            $AMOUNT = $_POST['AMOUNT'][$i];
            $TOTAL_AMOUNT = $_POST['TOTAL_AMOUNT'][$i];


            global $mydb;
            $statementexp = "INSERT INTO tblarea_expenses (`AREAID`, `CATEGORY`, `SCOPE_OF_WORK`, `PCS`, `AMOUNT`, `TOTAL_AMOUNT`) VALUES (
'$AREAID','$CATEGORY','$SCOPE_OF_WORK','$PCS','$AMOUNT','$TOTAL_AMOUNT')";
            $mydb->setQuery($statementexp);
            //$cur = $mydb->loadResultList();

        }

        // $areas->create();
         $output = $item_c;
       // $output = $_POST['scope1'];

        if ($istrue == 1) {

            message("New Area Expenses has been created successfully!" . $output, "success");
           // http://localhost/pems/module/project/index.php?view=view&id=1
           redirect('../project/index.php?view=view$id='.$PROJECTID);

        }


    }

}

function doEdit()
{
    global $mydb;
    if (isset($_POST['save'])) {

        $defaults = new Defaults();
        $dftid = $_POST['dftid'];


        /*if($default=="YES"){
         $mydb->InsertThis("UPDATE `tblcommonmaster` SET `IS_DEFAULT` = 'NO' WHERE CATEGORY='{$category}' AND IS_DEFAULT='YES' ");
         }*/
        $COMMONCODE = $category . $item;

        $defaults->COMMON_CODE = $COMMONCODE;
        $defaults->CATEGORY = $category;
        $defaults->LISTNAME = $item;
        $defaults->IS_DEFAULT = $default;
        $defaults->updatedefaults($dftid);

        message("Expense [" . $item . "] has been updated successfully!", "success");
        redirect('index.php');

    }


}


function doDelete()
{


    $id = $_GET['id'];

    $area = new Area();
    $area->delete($id);
    message("Expenses has been Deleted!", "info");
    //redirect('index.php');
    redirect('../project/index.php?view=view&id='.$_SESSION['projectId']);
    // }
    // }

    //5/
}

function doupdateimage()
{

    $errofile = $_FILES['photo']['error'];
    $type = $_FILES['photo']['type'];
    $temp = $_FILES['photo']['tmp_name'];
    $myfile = $_FILES['photo']['name'];
    $location = "photos/" . $myfile;


    if ($errofile > 0) {
        message("No Image Selected!", "error");
        redirect("index.php?view=view&id=" . $_GET['id']);
    } else {

        @$file = $_FILES['photo']['tmp_name'];
        @$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
        @$image_name = addslashes($_FILES['photo']['name']);
        @$image_size = getimagesize($_FILES['photo']['tmp_name']);

        if ($image_size == FALSE) {
            message("Uploaded file is not an image!", "error");
            redirect("index.php?view=view&id=" . $_GET['id']);
        } else {
            //uploading the file
            move_uploaded_file($temp, "photos/" . $myfile);


            $user = New User();
            $user->USERIMAGE = $location;
            $user->update($_SESSION['USERID']);
            redirect("index.php");


        }
    }

}

?>