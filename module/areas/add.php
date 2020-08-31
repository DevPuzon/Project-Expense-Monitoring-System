<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<div class="container">
    <div class="card   mx-auto mt-2">
        <div class="card-header">Add Area Expenses

        </div>
        <div class="card-body">
            <form action="controller.php?action=add" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="category">Project Name</label>
                            <select class="form-control input-sm" name="PROJECTID" required readonly>
                                <option></option>
                                <?php global $mydb;
                                $mydb->setQuery("SELECT * FROM  `tblproject`");
                                $cur = $mydb->loadResultList();
                                foreach ($cur as $r) { ?>
                                    <option value="<?= $r->PROJECTID; ?>" <?php if($_SESSION['projectId']==$r->PROJECTID) { echo "selected";} ?> ><?= $r->PROJECTNAME; ?></option>
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
                            "Block" type="text" value="" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="item">Block No.</label>
                            <input class="form-control input-sm" id="BLOCK_NO" name="BLOCK_NO" placeholder=
                            "Lot" type="text" value="" required>
                        </div>
                    </div>
                </div>
				
                <!-- <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="item">Cash Advance</label>
                            <input class="form-control input-sm" id="TOTAL_CASH_ADVANCE" name="TOTAL_CASH_ADVANCE" placeholder=
                            "Cash Advance" type="text" value="" required>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="item">Cash Advance Details</label>
                            <input class="form-control input-sm" id="CASH_ADVANCE_DETAILS" name="CASH_ADVANCE_DETAILS" placeholder=
                            "Cash Advance Detailss" type="text" value="" required>
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="item">Total Expenses</label>
                            <input class="form-control input-sm" id="TOTAL_EXPENSES" name="TOTAL_EXPENSES" placeholder=
                            "Total Expenses" type="text" value="" required readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="item">Total Quantity</label>
                            <input class="form-control input-sm" id="TOTAL_QTY" name="TOTAL_QTY" placeholder=
                            "Total Quantity" type="text" value="" required readonly>
                        </div>
                    </div>
                </div>

                <h4>Expenses Details</h4>
                <div class="col-md-12">
                    <table class="table table-bordered dynamic_field" id="">
                        <tr>
                            <td width="150px">Category</td>
                            <td>Sub Contractor</td>
                            <td width="100px">Pcs</td>
                            <td width="180px">Amount</td>
                            <td width="180px">Total Amount</td>
                            <td width="100px">Action</td>
                        </tr>
                            <tr>
                                <td>
                                    <select name="CATEGORY[]" class="form-control select">
                                        <option></option>
                                        <?php
                                        $mydb->setQuery("SELECT * FROM  `tblconstants` WHERE CATTYPE='Category'");
                                        $cur = $mydb->loadResultList();
                                        foreach ($cur as $r) { ?>
                                            <option value="<?= $r->VALUE; ?>"><?= $r->VALUE; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="SCOPE_OF_WORK[]" id="SCOPE_OF_WORK" class="form-control"
                                           required>
                                </td>
                                <td>
                                    <input type="number" name="PCS[]" id="PCS" min="1" class="form-control"
                                           onchange="findTotal()"
                                           required>
                                </td>
                                <td>
                                    <input type="number" name="AMOUNT[]" id="AMOUNT" min="1" class="form-control"
                                           onchange="findTotal()"
                                           required>
                                </td>
                                <td>
                                    <input type="number" name="TOTAL_AMOUNT[]" id="xtotal0" min="1"
                                           class="form-control"
                                           required readonly>
                                </td>

                                <td>
                                    <button type="button" name="add" id="add" class="btn btn-success add"> Add
                                    </button>
                                </td>
                            </tr>
                    </table>
                </div> 

                
                <h4>Cash Advance Details</h4>
                <div class="col-md-12">
                    <table class="table table-bordered dynamic_field1" id="">
                        <tr>
                            <td width="150px">Category</td> 
                            <td width="180px">Sub Contractor</td>   
                            <td width="180px">Amount</td> 
                            <td width="100px">Action</td>
                        </tr>
                            <tr>
                                <td>
                                    <select name="CATEGORY1[]" class="form-control select">
                                        <option></option>
                                        <?php
                                        $mydb->setQuery("SELECT * FROM  `tbl_cashadv`");
                                        $cur = $mydb->loadResultList();
                                        foreach ($cur as $r) { ?>
                                            <option value="<?= $r->col_id; ?>"><?= $r->col_cat; ?></option>
                                        <?php } ?>
                                    </select>
                                </td> 
                                <td>
                                    <input type="text" name="SCOPE_OF_WORK1[]" id="xtotal0" min="1"
                                           class="form-control"
                                           required >
                                </td>
                                <td>
                                    <input type="number" name="AMOUNT1[]" id="xtotal0" min="1"
                                           class="form-control"
                                           required >
                                </td>

                                <td>
                                    <button type="button" name="add1" id="add1" class="btn btn-success add1"> Add
                                    </button>
                                </td>
                            </tr>
                    </table>
                </div> 
                <button class="btn btn-primary btn-block" name="save" type="submit">
                    <span class="glyphicon glyphicon-floppy-save"></span> Save Expense
                </button>


            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        var i = 0   ;
        var x = 0   ;
        $('.add').click(function () {
            i++;
            $('.dynamic_field').append(
                '<tr id="row' + i + '">  ' +
                '<td>' +
                '   <select type="text" name="CATEGORY[]" id="CATEGORY' + i + '"  class="form-control select"  required>' +
                '<option></option>' +
                '<?php  global $mydb;   $statementexp = "SELECT VALUE FROM  tblconstants  WHERE CATTYPE='Category'";  $mydb->setQuery($statementexp);   $cur = $mydb->loadResultList();   foreach ($cur as $r) {  ?> ' +
                '<option value="<?= $r->VALUE; ?>"><?=$r->VALUE; ?></option>' +
                '  <?php } ?></select>' +
                ' </td>' +
                ' <td>' +
                '    <input type="text" name="SCOPE_OF_WORK[]" id="SCOPE_OF_WORK" class="form-control" required>\n' +
                '</td>' +
                ' <td>' +
                '    <input type="number" name="PCS[]" id="PCS" min="1" step="any" onchange="findTotal()" class="form-control" required>\n' +
                '</td>' +
                ' <td>' +
                '    <input type="number" name="AMOUNT[]" id="AMOUNT" min="1" step="any" onchange="findTotal()" class="form-control" required>\n' +
                '</td>' +
                ' <td>' +
                '    <input type="text" name="TOTAL_AMOUNT[]"  min="1" step="any" id="xtotal' + i + '" value="'+ i +'" class="form-control" required readonly>\n' +
                '</td>' +
                '<td> ' +
                ' <button name="remove" id="' + i + '"  class="btn btn-danger btn_remove"> Remove</button>  ' +
                '</td></tr>'
            );  
        });

        
        $('.add1').click(function () {
            x++; 
            console.log(x);
            
            $('.dynamic_field1').append(
                '<tr id="row1' + x+ '">  ' +
                '<td>' +
                '   <select type="text" name="CATEGORY1[]" id="CATEGORY1' + x + '"  class="form-control select"  required>' +
                '<option></option>' +
                '<?php  global $mydb;   $statementexp = "SELECT * FROM  tbl_cashadv ";  $mydb->setQuery($statementexp);   $cur = $mydb->loadResultList();   foreach ($cur as $r) {  ?> ' +
                '<option value="<?= $r->col_id; ?>"><?=$r->col_cat; ?></option>' +
                '  <?php } ?></select>' +
                ' </td>' +  
                ' <td>' +
                '    <input type="text" name="SCOPE_OF_WORK1[]" id="SCOPE_OF_WORK1" min="1" step="any"   class="form-control" required>\n' +
                '</td>' + 
                ' <td>' +
                '    <input type="number" name="AMOUNT1[]" id="AMOUNT1" min="1" step="any"   class="form-control" required>\n' +
                '</td>' +  
                '<td> ' +
                ' <button name="remove" id="1' + x + '"  class="btn btn-danger btn_remove1"> Remove</button>  ' +
                '</td></tr>'
            );

        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $("#row" + button_id + "").remove();
        })
    });


    function findTotal() {
        var item_qy_arr = document.getElementsByName('PCS[]');
        var unit_am_arr = document.getElementsByName('AMOUNT[]');
        var qtyTotal = 0;
        var total = 0;
        var grandTotal = 0;
        var xtotalId = "";
        for (var i = 0; i < item_qy_arr.length; i++) {
            if (parseInt(item_qy_arr[i].value))

                grandTotal += (item_qy_arr[i].value) * (unit_am_arr[i].value);
            qtyTotal += parseInt(item_qy_arr[i].value);

           // alert(grandTotal);
            xtotalId = "xtotal" + i;
            document.getElementById(xtotalId).value = (item_qy_arr[i].value * unit_am_arr[i].value).toFixed(2);
            //alert(grandTotal);
        }

        document.getElementById('TOTAL_EXPENSES').value = grandTotal.toFixed(2);
        document.getElementById('TOTAL_QTY').value = qtyTotal;
    }

</script>