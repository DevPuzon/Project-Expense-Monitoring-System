<?php 
  if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."admin/index.php");
   }


 ?> 

 <div class="container">
  <div class="card card-register mx-auto mt-2">
    <div class="card-header">Add new Default</div>
    <div class="card-body">  
 <form action="controller.php?action=add" method="POST">
          <div class="form-group">
           <div class="form-row">
                  <div class="col-md">
                <label for="category">Category</label>

                   <input class="form-control input-sm" id="category" name="category" placeholder=
                      "Category" type="text" value="" required>
                </div>
              </div>
            </div>

             <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label  for="item">Item</label>

                           <input class="form-control input-sm" id="item" name="item" placeholder=
                            "Item" type="text" value="" required>
                      </div>
                    </div>
                  </div>
                   <div class="form-group">
                  <div class="form-row">
                        <div class="col-md">
                      <label  for="default">Set Default?</label>

                          <select class="form-control input-sm" name="default" id="default">
                           <option value="NO">NO</option>
                            <option value="YES">YES</option>
                          </select>
                      </div>
                    </div>
                  </div>
             
            <button class="btn btn-primary btn-block" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save Default</button>

              
        </form>
             </div>
    </div>
  </div>
 