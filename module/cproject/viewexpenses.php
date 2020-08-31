<?php 
  if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."admin/index.php");
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
  <div class="col-lg-6">
     <div class="card mb-3">

      <div class="card-header">
              <i class="fa fa-bar-chart"></i> Project Details
      </div>
      
        <div class="card-body">
          <form class="form-horizontal span4" action="" method="POST">
                <table class="table-striped" align="left"  width="100%" >  
                  
                  <tbody>           
                    <tr>
                 
                      <td><strong>Project Name</strong></td><td> <?php echo (isset($sProject)) ? $sProject->PROJECTNAME : 'Project Name' ;?>
                      <tr>
                      <td><strong>Start Date </strong></td><td>  <?php echo (isset($sProject)) ? $sProject->STARTDATE : 'Start Date' ;?>
                      <tr>
                      <td><strong>End Date </strong></td><td> <?php echo (isset($sProject)) ? $sProject->ENDDATE : 'Start Date' ;?>
                     
                      <tr>
                      <td><strong>Project Status</strong></td><td> <?php echo (isset($sProject)) ? $sProject->PROJECTSTATUS : 'Status' ;?>
                     
                    </tr>
                  </tbody>
                </table>
            </form>

        </div>
    </div> 

  </div>
  <div class="col-lg-6">
    <div class="card mb-3">

      <div class="card-header">
              <i class="fa fa-bar-chart"></i> Expense Summary
      </div>
      
        <div class="card-body">
          <form>
            <table class="table-striped" id="expsummary" align="left"  width="100%" >
              <thead>
              <tr>
                 <th>No.</th>
                  <th>Type Of Expenses</th>
                  <th>Total Expenses</th>
              </tr>
            </thead>
            </table>  
          </form>
        </div>
    </div> 
  </div>
  
</div>

<div class="row">

    <div class="col-lg-12">
     <div class="card mb-3">
         <div class="card-header">
              <i class="fa fa-bar-chart"></i> Detailed Expenses 
              <?php

              if ($sProject->PROJECTSTATUS == 'ONGOING'){
                  echo ' <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#addexpenses" id="addNewExpenses">  <i class="fa fa-plus-circle fw-fa"></i> New</button>';
              }
              ?>
              
       </div>
          <div class="card-body">
            <div class="table-responsive">
               <form action="" Method="POST">           
            <table id="expenselist" class="table table-striped" style="100%" cellspacing="0">
              
                <thead>
                    <tr>
                    <th>No.</th>
                    <th>Type</th>
                    <th>Item</th>
                    <th>Supplier</th>
                    <th>Amount</th>
                    <th>Requested</th>
                    <th>Date Added</th>             
                    <th>Encoder</th>
                  </tr> 
                </thead>
                
               
              </table>
             
              </form>
            </div>
            </div>  
      </div>      
    </div>
      <!-- /.col-lg-12 -->
</div>
 <div class="modal fade" id="addexpenses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <form  id="expform" method="POST">
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
                      <label for="exptype">Expense Type :</label>
                       <select class="form-control input-sm" name="exptype" id="exptype">
                        <?php

                          $Default = new Defaults();
                          $cur = $Default->list_default_expenses();
                           foreach ($cur as $def) {
                              echo '<option value="'. $def->LISTNAME.'">'.$def->LISTNAME .'</option>';
                            }

                        ?>
                        </select> 
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="Amount">Amount :</label>
                         <input class="form-control input-sm" id="Amount" name="Amount" placeholder="0.00" type="number" step=".01" min="0" required>
                      </div>
                    </div>
                  </div> 
                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="itemname">Item Name:</label>
                         <input class="form-control input-sm" id="itemname" name="itemname" placeholder=
                            "Item Name" type="text" required>
                      </div>
                    </div>
                  </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="Supplier">Supplier Name :</label>
                       <select class="form-control input-sm" name="Supplier" id="Supplier">
                        <?php

                          $Supplier = new Supplier();
                          $cursup = $Supplier->listOfSuppliers();
                           $output .= '<option value="N/A">N/A</option>';
                           foreach ($cursup as $sup) {
                              $output .= '<option value="'. $sup->SUPNAME.'">'.$sup->SUPNAME .'</option>';
                            }
                            echo $output;

                        ?>
                        </select> 
                      </div>
                    </div>
                  </div>
                
                
                   <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="REQUESTEDBY">Requested By:</label>

                         <input class="form-control input-sm" id="REQUESTEDBY" name="REQUESTEDBY" placeholder=
                            "Requested by" type="text" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="sdate">Date Given:</label>
                       <input class="form-control input-sm" id="sdate" name="dategiven"  type="date" required>
                      </div>
                    </div>
                  </div>

                 
     
          </div>
          <div class="modal-footer">
             <input  type="hidden"  class="btn btn-success" id="save" name="save" />
             <input type="hidden" name="operation" id="operation" />
            <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
             
          </div>
            
        </div>
         </form>
      </div>
    </div>
