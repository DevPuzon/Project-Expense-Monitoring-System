<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="card mb-3">

        <div class="card-header">
          <i class="fa fa-table"></i> List of Defaults   <a href="index.php?view=add" class="btn btn-primary  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a></div>

         
        <div class="card-body">
          <div class="table-responsive">
	 		    <form action="controller.php?action=delete" Method="POST">  
			    		
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>Code</th>
				  		<th>Category</th>
				  		<th>Default Name</th>
				  		<th>Active</th>
						 <th width="20%" >Action</th>
				  	</tr>	
				  </thead>
				  <tbody>
				  	<?php 
				  	global $mydb;
				  		$mydb->setQuery("select  * from tblcommonmaster");
						$cur = $mydb->loadResultList();

						foreach ($cur as $Defaults) {
				  		echo '<tr>';

				  		echo '<td>' . $Defaults->COMMONCODE .'</a></td>';
				  		echo '<td>'. $Defaults->CATEGORY.'</td>';
				  		echo '<td>'. $Defaults->LISTNAME.'</td>';
				  		echo '<td>'. $Defaults->IS_DEFAULT.'</td>';
				  		echo $active = "";
				  		
				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$Defaults->COMMON_ID.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="controller.php?action=delete&id='.$Defaults->COMMON_ID.'" class="btn btn-danger btn-xs delete" '.$active.'><span class="fa fa-trash-o fw-fa"></span> </a>
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