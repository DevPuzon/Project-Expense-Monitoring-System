<?php 
  if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."admin/index.php");
   }


 ?> 
  <div class="container">
    <div class="card card-register mx-auto mt-2">
      <div class="card-header">Add new Project</div>
      <div class="card-body">   
 <form action="controller.php?action=add" method="POST">

                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="name">Project Name:</label>

                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="name" name="projectname" placeholder=
                            "Project Name" type="text" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="sdate">Start Date:</label>
                       <input class="form-control input-sm" id="sdate" name="startdate"  type="date" required>
                      </div>
                    </div>
                  </div>

                 <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="edate">End Date:</label>
                         <input class="form-control input-sm" id="edate" name="enddate"  type="date" required>
                      </div>
                    </div>
                  </div>
                 <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="projectcost">Project Cost:</label>
                         <input class="form-control input-sm" id="projectcost" name="projectcost"  type="number" step=".01" min="0" required>
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="form-row">
                        <div class="col-md">
                      <label for="status">Project Status:</label>
                       <select class="form-control input-sm" name="status" id="status">
                          <option value="ONGOING">ONGOING</option>
                          <option value="FINISHED">FINISHED</option>
                         
                        </select> 
                      </div>
                    </div>
                  </div>
         
            <button class="btn btn-primary btn-block" name="save" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save Project</button>



          
        </form>
                   
      </div>
    </div>
  </div>
 </DIV>