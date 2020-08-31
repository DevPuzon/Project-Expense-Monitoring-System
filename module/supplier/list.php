<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="card mb-3">

        <div class="card-header">
          <i class="fa fa-table"></i> List of Supplier(s)   <a href="index.php?view=add" class="btn btn-primary  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a></div>

         
        <div class="card-body">
          <div class="table-responsive">
	 		<form action="controller.php?action=delete" Method="POST">  
			   		
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		
				  		<th>Code</th>
				  		<th>Supplier Name</th>
				  		<th>TIN</th>
				  		<th>Address</th>
				  		<th>Contact</th>
				  		<th width="15%" >Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  
				  	<?php 
				  		global $mydb;
				  		 $Supplier = new Supplier();
				  		$cur = $Supplier->listOfSuppliers();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		//`SUPID`, `SUPCODE`, `SUPNAME`, `SUPTIN`, `SUPADD`, `SUPCONTACT`, `SUPREMARKS`
				  		echo '<td>' . $result->SUPCODE.'</a></td>';
				  		echo '<td>' . $result->SUPNAME.'</a></td>';
				  		echo '<td>'. $result->SUPTIN.'</td>';
				  		echo '<td>'. $result->SUPADD.'</td>';
						echo '<td>'. $result->SUPCONTACT.'</td>';
				  		echo '<td align="center" > 

				  			<a title="Edit" href="index.php?view=edit&id='.$result->SUPID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
							
				  		</td>';
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
					
				</table>
 

				</form>
       </div>
        </div>
      
      </div>