<?php  
      if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }
$dft = $_GET['id'];
$singledft = new Defaults();
$object = $singledft->single_default($dft);

?> 
 <div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Update Default Details</div>
    <div class="card-body">  
 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">
          <div class="form-group">
                  <div class="form-row">
                  <div class="col-md">
                      <label for="category">Category</label>
                          <input name="dftid" type="hidden" value="<?php echo $object->COMMON_ID;?>">
                         <input class="form-control input-sm" id="category" name="category" placeholder=
                            "Category" type="text" value="<?php echo $object->CATEGORY;?>">
                      </div>
                    </div>
                  </div>

             <div class="form-group">
                   <div class="form-row">
                  <div class="col-md">
                      <label  for="item">Item</label>

                       <input class="form-control input-sm" id="item" name="item" placeholder=
                            "Item" type="text" value="<?php echo $object->LISTNAME;?>">
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                  <div class="form-row">
                  <div class="col-md">
                      <label  for="default">Set Default?</label>
                           <select class="form-control input-sm" name="default" id="default">
                          <?php
                            if ($object->ISDEFAULT == 'YES'){
                               echo '<option value="YES" selected="selected">YES</option>';
                               echo '<option value="NO" >NO</option>';
                            }else{
                                echo '<option value="YES" >YES</option>';
                               echo '<option value="NO" selected="selected">NO</option>';
                            }

                            ?>
                          </select>
                      </div>
                    </div>
            <button class="btn btn-primary btn-block" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save Defaults</button>

              
        </form>
             </div>
    </div>
  </div>
 