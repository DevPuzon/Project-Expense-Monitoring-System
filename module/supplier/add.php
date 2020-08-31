<?php 
  if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."admin/index.php");
   }


 ?> 
  <div class="container">
    <div class="card card-register mx-auto mt-2">
      <div class="card-header">Add new Supplier</div>
      <div class="card-body">   
 <form action="controller.php?action=add" method="POST">

                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="supcode">Supplier Code:</label>
                      <?php
                         date_default_timezone_set('Asia/Manila'); 
                          
                         $created =  strftime("%d%H%M%S", time()); 
                       ?>
                       <input class="form-control input-sm" id="supcode" name="SUPCODE" placeholder=
                            " Code" type="text" value="<?php echo "S".$created; ?>" readonly>
                      </div>
                    </div>
                  </div>
 
                     <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="SUPNAME">Supplier Name:</label>
                       <input class="form-control input-sm" id="SUPNAME" name="SUPNAME" placeholder=
                            " Name" type="text" required>
                      </div>
                    </div>
                  </div>

                 <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="SUPTIN">Supplier TIN:</label>
                       <input class="form-control input-sm" id="SUPTIN" name="SUPTIN" placeholder=
                            " TIN" type="text" >
                      </div>
                    </div>
                  </div>

                 <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="SUPADD">Supplier Address:</label>
                       <input class="form-control input-sm" id="SUPADD" name="SUPADD" placeholder=
                            " Address" type="text" >
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="SUPTIN">Supplier Contact:</label>
                       <input class="form-control input-sm" id="SUPCONTACT" name="SUPCONTACT" placeholder=
                            " Contact" type="text" >
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="SUPREMARKS"> Remarks:</label>
                       <input class="form-control input-sm" id="SUPREMARKS" name="SUPREMARKS" placeholder=
                            " Remarks" type="text" >
                      </div>
                    </div>
                  </div>

         
            <button class="btn btn-primary btn-block" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save Supplier</button>
          
        </form>
                   
      </div>
    </div>
  </div>
 </DIV>