<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}
$dft = $_GET['id'];
$singledft = new Area();
$object = $singledft->single_default($dft);

?>
<div class="container">
    <div class="card card-register mx-auto mt-2">
        <div class="card-header">Update Expense Details</div>
        <div class="card-body">
            <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">
                <input name="dftid" type="hidden" value="<?php echo $object->AREAID; ?>">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="category">Project Name</label>
                            <select class="form-control input-sm" name="PROJECTID" required>
                                <option></option>
                                <?php global $mydb;
                                $mydb->setQuery("SELECT * FROM  `tblproject`");
                                $cur = $mydb->loadResultList();
                                foreach ($cur as $r) { ?>
                                    <option value="<?= $r->PROJECTID; ?>"  <?php if($r->PROJECTID==$object->PROJECTID) {  echo "SELECTED";}?>><?= $r->PROJECTNAME; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="item">Lot No.</label>
                            <input class="form-control input-sm" id="LOT_NO" name="LOT_NO" placeholder=
                            "Lot No." type="text" value="<?php echo $object->LOT_NO;?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="item">Block No.</label>
                            <input class="form-control input-sm" id="BLOCK_NO" name="BLOCK_NO" placeholder=
                            "Block No." type="text" value="<?php echo $object->BLOCK_NO;?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="item">Total Expenses</label>
                            <input class="form-control input-sm" id="TOTAL_EXPENSES" name="TOTAL_EXPENSES" placeholder=
                            "Total Amount" type="text" value="<?php echo $object->TOTAL_EXPENSES;?>" readonly>
                        </div>
                    </div>
                </div>
<!--                <div class="form-group">-->
<!--                    <div class="form-row">-->
<!--                        <div class="col-md">-->
<!--                            <label for="item">TOTAL QTY</label>-->
<!--                            <input class="form-control input-sm" id="TOTAL_QTY" name="TOTAL_QTY" placeholder=-->
<!--                            "Total Qty" type="text"  readonly>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <h4>Expenses Details</h4>-->
<!--                <div class="col-md-12">-->
<!--                    <table class="table table-bordered dynamic_field" id="">-->
<!---->
<!--                    </table>-->
<!--                </div>-->

                <button class="btn btn-primary btn-block" name="save" type="submit"><span
                            class="glyphicon glyphicon-floppy-save"></span> Save Defaults
                </button>


            </form>
        </div>
    </div>
</div>
 