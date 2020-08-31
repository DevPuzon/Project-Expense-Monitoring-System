<?php  
      if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

  @$USERID = $_GET['id'];
    if($USERID==''){
  redirect("index.php");
}
  $user = New User();
  $singleuser = $user->single_user($USERID);

?> 
<div class="container">
    <div class="card card-register mx-auto mt-2">
      <div class="card-header">Update User Account</div>
      <div class="card-body"> 
 <form  action="controller.php?action=edit" method="POST">

          
                   
                    <!-- <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "user_id">User Id:</label> -->

                      <!-- <div class="col-md-8"> -->
                        
                         <input id="USERID" name="USERID" type="Hidden" value="<?php echo $singleuser->ACCOUNT_ID; ?>">
                   <!--    </div>
                    </div>
                  </div>      -->      
                  
                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label  for="U_NAME">Name:</label>
                           <input class="form-control input-sm" id="U_NAME" name="U_NAME" placeholder=
                            "Account Name" type="text" value="<?php echo $singleuser->ACCOUNT_NAME; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label  for="U_USERNAME">Username:</label>

                         <input class="form-control input-sm" id="U_USERNAME" name="U_USERNAME" placeholder=
                            "Email Address" type="text" value="<?php echo $singleuser->ACCOUNT_USERNAME; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label  for="U_PASS">Password:</label>
                       <input class="form-control input-sm" id="U_PASS" name="U_PASS" placeholder=
                            "Account Password" type="Password" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                   <div class="form-row">
                        <div class="col-md">
                      <label  for="U_ROLE">Role:</label>

                       <select class="form-control input-sm" name="U_ROLE" id="U_ROLE">
                          <option value="Administrator"  <?php echo ($singleuser->ACCOUNT_TYPE=='Administrator') ? 'selected="true"': '' ; ?>>Administrator</option>
                          <option value="Employee" <?php echo ($singleuser->ACCOUNT_TYPE=='Employee') ? 'selected="true"': '' ; ?>>Employee</option> 
                           
                       
                        </select> 
                      </div>
                    </div>
                  </div>

              <button class="btn btn-primary btn-block" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save User</button>

   
          
        </form>
      

      </div>
    </div>
  </div>
 