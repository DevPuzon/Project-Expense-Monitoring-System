<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="card mb-3">

        <div class="card-header">
          <i class="fa fa-table"></i> List of Area   <a href="index.php?view=add" class="btn btn-primary  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a></div>

         
        <div class="card-body">
          <div class="table-responsive">
	 		    <form action="controller.php?action=delete" Method="POST">  
			    		
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				
				  <thead>
				  	<tr>
				  	<!-- 	<th>Code</th> -->
				  		<th>Lot</th>
				  		<th>Block</th>
                        <th>TOTAL AMOUNT</th>
						 <th width="20%" >Action</th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				  	global $mydb;
				  		$mydb->setQuery("select  * from tblareas");
						$cur = $mydb->loadResultList();

						foreach ($cur as $Defaults) {
				  		echo '<tr>';

				  /*		echo '<td>' . $Defaults->COMMONCODE.'</a></td>';*/
				  		echo '<td>'. $Defaults->Block_No.'</td>';
				  		echo '<td>'. $Defaults->Lot_NO.'</td>';
				  		echo '<td>'. $Defaults->TOTAL_EXPENSES.'</td>';
				  		echo $active = "";
				  		
				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$Defaults->AREAID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="controller.php?action=delete&id='.$Defaults->AREAID.'" class="btn btn-danger btn-xs delete" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
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