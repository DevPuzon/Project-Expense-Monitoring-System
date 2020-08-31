<?php 
  if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."admin/index.php");
   }


 ?> 
  <div class="container">
    <div class="card card-register mx-auto mt-2">
      <div class="card-header">Add Category</div>
      <div class="card-body">   
 <form action="controller.php?action=add" method="POST">


 
                     <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="SUPNAME">Category :</label>
                            <input value="Category" name="CATTYPE" type="text">
                       <input class="form-control input-sm" id="VALUE" name="VALUE" placeholder=
                            " Category" type="text" required>
                      </div>
                    </div>
                  </div>


            <button class="btn btn-primary btn-block" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save Category</button>
          
        </form>
                   
      </div>
    </div>
  </div>
 </DIV>