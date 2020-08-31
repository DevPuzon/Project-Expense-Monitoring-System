<?php
require_once("../../include/initialize.php");
$projectId = $_SESSION['projectId'] = $_GET['id'];
global $mydb;
$statementexp = "SELECT SUM(total_expenses)projectexpenses FROM `tblareas` WHERE PROJECTID =" . $projectId . "";
$mydb->setQuery($statementexp);
$cur = $mydb->loadResultList();
foreach ($cur as $r) {
    $statementexp = "UPDATE tblproject SET projectexpenses=' $r->projectexpenses' WHERE PROJECTID='$projectId'";
    $mydb->setQuery($statementexp);
}
?>

<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}
@$projectID = $_GET['id'];
$Project = New Project();
$sProject = $Project->single_project($projectID);
unset($_SESSION['id']);
$_SESSION['id'] = $projectID;
?>
<?php
check_message();
?>


<div class="row">
    <div class="col-md-7">
        <div class="card mb-3">

            <div class="card-header">
                <i class="fa fa-bar-chart"></i> Project Details
            </div>

            <div class="card-body">
                <form class="form-horizontal span4" action="" method="POST">
                    <table class="table-striped" align="left" width="100%">

                        <tbody>
                        <tr>

                            <td><strong>Project Name</strong></td>
                            <td align="left"> <?php echo (isset($sProject)) ? $sProject->PROJECTNAME : 'Project Name'; ?>
                        <tr>
                            <td><strong>Start Date </strong></td>
                            <td>  <?php echo (isset($sProject)) ? $sProject->STARTDATE : 'Start Date'; ?>
                        <tr>
                            <td><strong>End Date </strong></td>
                            <td> <?php echo (isset($sProject)) ? $sProject->ENDDATE : 'Start Date'; ?>
                        <tr>
                            <td><strong>Project Cost</strong></td>
                            <td> <?php echo (isset($sProject)) ? number_format($sProject->PROJECTCOST, 2) : 'Project Cost'; ?>
                                <?php
                                $cost = $sProject->PROJECTCOST;
                                $exp = $sProject->PROJECTEXPENSES;
                                $remFund = $cost - $exp;
                                ?>

                        <tr>
                            <td><strong>Total Expenses</strong></td>
                            <td> <?php echo (isset($sProject)) ? number_format($sProject->PROJECTEXPENSES, 2) : 'Total Expenses'; ?>
                        <tr>
                            <td><strong>Available Funds</strong></td>
                            <td> <?php echo (isset($sProject)) ? number_format($remFund, 2) : 'Available Funds'; ?><br/>
                        <tr>
                            <td><strong>Project Status</strong></td>
                            <td> <?php echo (isset($sProject)) ? $sProject->PROJECTSTATUS : 'Status'; ?>

                        </tr>
                        </tbody>
                    </table>
                </form>

            </div>
        </div>

    </div>


    <div class="col-md-5">
        <div class="card mb-3">
 
			
			   <div class="card-header">
                <i class="fa fa-bar-chart"></i>Area Details
                <a href="../areas/index.php?view=add" class="btn btn-primary btn-sm"> <i
                            class="fa fa-plus-circle fw-fa"></i> New</a>
            </div>

            <div class="card-body">

                <table class="table-striped" align="left" width="100%">
                    <thead>
                    <tr>
                        <th>Lot No.</th>
                        <th>Block No.</th>
                        <th>Total Expenses</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $mydb->setQuery("select  *  from tblareas  WHERE PROJECTID='$projectId' ");
                    $cur = $mydb->loadResultList();
                    foreach ($cur as $Defaults) {
                        echo '<tr>';
                        echo '<td>' . $Defaults->LOT_NO . '</td>';
                        echo '<td>' . $Defaults->BLOCK_NO . '</td>';
                        echo '<td>' . $Defaults->TOTAL_EXPENSES . '</td>';
                        echo '<td align="center" > <a title="Edit" href="../areas/index.php?view=edit&id=' . $Defaults->AREAID . '"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="../areas/controller.php?action=delete&id=' . $Defaults->AREAID . '" class="btn btn-danger btn-xs delete"><span class="fa fa-trash-o fw-fa"></span> </a>
				  					 </td>';
                        echo '</tr>';
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-12">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-bar-chart"></i> Detailed Expenses
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addexpenses"> <i class="fa fa-plus-circle fw-fa"></i> New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <form action="" Method="POST">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                            <tr>
                            <tr>
                                <!-- 	<th>Code</th> -->
                                <th>Category</th>
                                <th>Sub Contractor</th>
                                <th>Pcs</th>
                                <th>Amount</th>
                                <th>Total Amount</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $mydb->setQuery("select  *,a.AREAID from tblareas a INNER JOIN tblarea_expenses ea ON ea.AREAID=a.AREAID WHERE PROJECTID='$projectId' ");
                            $cur = $mydb->loadResultList();
                            foreach ($cur as $Defaults) {
                                echo '<tr>';
                                echo '<td>' . $Defaults->CATEGORY . '</td>';
                                echo '<td>' . $Defaults->SCOPE_OF_WORK . '</td>';
                                echo '<td>' . $Defaults->PCS . '</td>';
                                echo '<td>' . $Defaults->AMOUNT . '</td>';
                                echo '<td>' . $Defaults->TOTAL_AMOUNT . '</td>';
                                echo $active = "";

                                echo '<td align="center" > 
<a title="Edit" href="../areas/index.php?view=edit&id=' . $Defaults->AREAID . '"  class="btn btn-primary btn-xs  " data-toggle="modal" data-target="#editExpenses' . $Defaults->AREAID . '" id="editExpenses">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="../areas/controller.php?action=delete&id=' . $Defaults->AREAID . '" class="btn btn-danger btn-xs delete" ' . $active . '><span class="fa fa-trash-o fw-fa"></span> </a>
				  					 </td>';
                                echo '</tr>';
                            }
                            ?>
                            </tbody>


                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="modal fade" id="addexpenses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
            <form action="controller.php?action=addDExpenses" method="POST">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Expenses</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input name="PROJECTID" type="hidden" value="<?php echo $sProject->PROJECTID; ?>">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md">
                                <label for="exptype">Area :</label>
                                <select class="form-control input-sm select" name="AREAID" id="AREAID">
                                    <?php

                                    $mydb->setQuery("select  *  from tblareas  WHERE PROJECTID='$projectId' ");
                            $cur = $mydb->loadResultList();
                            foreach ($cur as $Defaults) {
								  echo '<option value="' . $Defaults->AREAID . '">' . $Defaults->AREAID. ' - '. $Defaults->BLOCK_NO . '</option>';
							}?>
                                </select>
                            </div>
                        </div>
                    </div>
					  <div class="form-group">
                        <div class="form-row">
                            <div class="col-md">
                                <label for="exptype">Category :</label>
                                <select class="form-control input-sm select" name="CATEGORY" id="CATEGORY"> 
                                  <?php
                                        $mydb->setQuery("SELECT * FROM  `tblconstants` WHERE CATTYPE='Category'");
                                        $cur = $mydb->loadResultList();
                                        foreach ($cur as $r) { ?>
                                            <option value="<?= $r->VALUE; ?>"><?= $r->VALUE; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
					 
 <div class="form-group">
                        <div class="form-row">
                            <div class="col-md">
                                <label for="Amount">Sub Contractor :</label>
                                <input class="form-control input-sm" id="SCOPE_OF_WORK" name="SCOPE_OF_WORK" placeholder="Sub Contractor"
                                       type="text"   required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md">
                                <label for="Amount">Pcs :</label>
                                <input class="form-control input-sm" id="PCS" name="PCS" placeholder="Pcs"
                                       type="number"   min="0" required>
                            </div>
                        </div>
                    </div>
					  <div class="form-group">
                        <div class="form-row">
                            <div class="col-md">
                                <label for="Amount">Amount :</label>
                                <input class="form-control input-sm" id="AMOUNT" name="AMOUNT" placeholder="Amount"
                                       type="number"   min="0" required>
                            </div>
                        </div>
                    </div>
					
                     
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="btn btn-success" id="save" name="save"/>
                    <input type="hidden" name="operation" id="operation"/>
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add"/>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                </div>

            </div>
        </form>
    </div>
</div>

<?php
$mydb->setQuery("select  *,a.AREAID from tblareas a INNER JOIN tblarea_expenses ea ON ea.AREAID=a.AREAID WHERE PROJECTID='$projectId' ");
$cur = $mydb->loadResultList();
foreach ($cur as $r) { ?>
    <div class="modal fade" id="editExpenses<?= $r->AREAID; ?>" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="controller.php?action=editExpenses" method="POST">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Expenses</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input name="AREAEXPENSEID" type="hidden" value="<?php echo $r->AREAEXPENSEID; ?>">
                        <input name="PROJECTID" type="hidden" value="<?php echo $r->PROJECTID; ?>">
                        <input name="AREAID" type="hidden" value="<?php echo $r->AREAID; ?>">

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md">
                                    <label for="sdate">Category:</label>
                                    <select name="CATEGORY" class="form-control select" required>
                                        <option></option>
                                        <?php
                                        $mydb->setQuery("SELECT * FROM  `tblconstants` WHERE CATTYPE='Category'");
                                        $res = $mydb->loadResultList();
                                        foreach ($res as $row) { ?>
                                            <option value="<?= $row->VALUE; ?>"  <?php if($r->CATEGORY==$row->VALUE) {  echo "SELECTED";}?>><?= $row->VALUE; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md">
                                    <label for="sdate">Sub Contractor</label>
                                    <input class="form-control input-sm" id="SCOPE_OF_WORK" name="SCOPE_OF_WORK" value="<?=$r->SCOPE_OF_WORK;?>" type="text"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md">
                                    <label for="sdate">Pcs:</label>
                                    <input class="form-control input-sm" id="PCS" name="PCS" type="number"  onchange="findTotal()"    value="<?=$r->PCS;?>"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md">
                                    <label for="sdate">Amount:</label>
                                    <input class="form-control input-sm" id="AMOUNT" name="AMOUNT" type="number" step="any" value="<?=$r->AMOUNT;?>"
                                           required>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="action" id="action" class="btn btn-warning" value="Update"/>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    </div>

                </div>
            </form>
        </div>
    </div>
<?php } ?>

<!-- The Modal -->
<div class="modal fade" id="addAmount">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="expform" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body edit-content">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function findTotal() {
        var item_qy_arr = document.getElementsByName('PCS');
        var unit_am_arr = document.getElementsByName('AMOUNT');
    document.getElementById('TOTAL_AMOUNT').value = (item_qy_arr.value * unit_am_arr.value).toFixed(2);
    }
</script>