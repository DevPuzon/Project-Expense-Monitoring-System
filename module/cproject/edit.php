<?php 
  if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."admin/index.php");
   }
    @$projectID = $_GET['id'];
  $Project = New Project();
  $sProject = $Project->single_project($projectID);


 ?> 

  <div class="container">
    <div class="card card-register mx-auto mt-2">
      <div class="card-header">Edit Project Details</div>
      <div class="card-body">   
 <form action="controller.php?action=edit" method="POST">

                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="name">Project Name:</label>

                        <input name="PROJECTID" type="hidden" value="<?php echo $sProject->PROJECTID; ?>">
                         <input class="form-control input-sm" id="name" name="projectname" placeholder=
                            "Project Name" type="text" value="<?php echo $sProject->PROJECTNAME; ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="sdate">Start Date:</label>
                       <input class="form-control input-sm" id="sdate" name="startdate"  type="date" value="<?php echo $sProject->STARTDATE; ?>" required>
                      </div>
                    </div>
                  </div>

                 <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="edate">End Date:</label>
                         <input class="form-control input-sm" id="edate" name="enddate"  type="date" value="<?php echo $sProject->ENDDATE; ?>" required>
                      </div>
                    </div>
                  </div>
                 <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="projectcost">Project Cost:</label>
                         <input class="form-control input-sm" id="projectcost" name="projectcost"  type="number" value="<?php echo $sProject->PROJECTCOST; ?>"  step=".01" min="0" required>
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="status">Project Status:</label>
                       <select class="form-control input-sm" name="status" id="status">
                        <?php 
                          if ($sProject->PROJECTSTATUS == 'ONGOING') {
                            echo ' <option value="ONGOING" selected>ONGOING</option>
                                   <option value="FINISHED">FINISHED</option>';
                          }elseif ($sProject->PROJECTSTATUS == 'FINISHED') {
                               echo ' <option value="ONGOING" >ONGOING</option>
                                   <option value="FINISHED" selected>FINISHED</option>';
                          }

                        ?>
                         
                         
                        </select> 
                      </div>
                    </div>
                  </div>
         
            <button class="btn btn-primary btn-block" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Modify Project</button>



          
        </form>
                   
      </div>
    </div>
  </div>
 </DIV>