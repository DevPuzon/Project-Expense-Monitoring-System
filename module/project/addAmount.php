<?php 
  if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."admin/index.php");
   }
    @$epxID = $_GET['id'];
  $Expenses = New Expenses();
  $exp = $Expenses->single_expenses($epxID);


 ?> 

  <div class="container">
    <div class="card card-register mx-auto mt-2">
      <div class="card-header">Edit Expense Amount</div>
      <div class="card-body">   
 <form action="controller.php?action=addAmount" method="POST">   
 
    
                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="type">Expense Type:</label>
                         <input class="form-control input-sm" id="expenses" name="type"  type="text" value="<?php echo $exp->EXPTYPE; ?>" readonly>
                      </div>
                    </div>
                  </div>

                 <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="expenses">Expense Amount:</label>
                         <input type="hidden" name="expid" value="<?php echo $exp->EXPID; ?>"> 
                         <input type="hidden" name="pid" value="<?php echo $exp->PROJECTID; ?>"> 
                         <input class="form-control input-sm" id="expenses" name="expenses"  type="number" value="<?php echo $exp->EXPENSES; ?>" step=".01" min="0" required>
                      </div>
                    </div>
                  </div>
                  
         
            <button class="btn btn-primary btn-block" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save Expense Amount</button>



          
        </form>
                   
      </div>
    </div>
  </div>
 </DIV>