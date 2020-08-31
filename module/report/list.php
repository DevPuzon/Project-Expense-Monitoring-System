<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}

?>
<div class="card mb-3">

    <div class="card-header">

        <form action="print.php" method="GET">
            <i class="fa fa-table"></i>


              Project
            <select class="form-control input-sm select" name="PROJECTID" id="PROJECTID">
                <option value="">- Select -</option>
                <?php
                $mydb->setQuery("SELECT *  FROM  tblproject  ");
                $cur = $mydb->loadResultList();
                foreach ($cur as $r) { ?>
                    <option value="<?= $r->PROJECTID; ?>"><?= $r->PROJECTNAME;  ?></option>
                <?php } ?>
            </select>
         
            Date From
            <input type="date" class="form-control" name="dtFrom" required>
            Date To
            <input type="date" class="form-control" name="dtTo" required>
            <br/>
            <button type="submit" class="btn btn-success"><i class="fa fa-print fw-fa"></i> Print</button>

        </form>
    </div>



</div>