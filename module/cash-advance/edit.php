<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}

@$suppcode = $_GET['id'];

$category = New CashAdvance();
$category = $category->single_category($suppcode);


?>
<div class="container">
    <div class="card card-register mx-auto mt-2">
        <div class="card-header">Edit Category</div>
        <div class="card-body">
            <form action="controller.php?action=edit" method="POST">

                <input name="col_id" type="hidden" value="<?php echo $category->col_id; ?>">
                 
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                            <label for="supcode">Value :</label>
                            <input class="form-control input-sm" id="col_cat" name="col_cat" placeholder=
                            " Code" type="text" value="<?php echo $category->col_cat; ?>" required="">
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-block" name="save" type="submit"><span
                            class="glyphicon glyphicon-floppy-save"></span> Save Category
                </button>

            </form>

        </div>
    </div>
</div>
</DIV>