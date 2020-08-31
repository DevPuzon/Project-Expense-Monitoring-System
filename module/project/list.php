<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<div class="card mb-3">

        <div class="card-header">
          <i class="fa fa-table"></i> List of Project(s)   <a href="index.php?view=add" class="btn btn-primary  ">  <i class="fa fa-plus-circle fw-fa"></i> New</a></div>

         
        <div class="card-body">
          <div class="table-responsive-sm">
	 		<form action="controller.php?action=delete" Method="POST">  
			   		
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		
				  		<th>Project Name</th>
				  		<th>Start Date</th>
				  		<th>End Date</th>
				  		<th>Remaining Days</th>
				  		<th>Project Cost</th>
				  		<th>Expenses</th>
						<th>Cash Advance</th>
				  		<th>Remaining Funds</th>
				  		<th>Status</th>
				  		<th width="15%" >Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  
				  	<?php 
				  		global $mydb;
				  		 $Project = new Project();
				  		$cur = $Project->listOfProjects();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		// `PROJECTID`, `PROJECTNAME`, `STARTDATE`, `ENDDATE`, ``, `PROJECTCOST`, `PROJECTSTATUS`
				  		echo '<td>' . $result->PROJECTNAME.'</a></td>';
				  		echo '<td>' . $result->STARTDATE.'</a></td>';
				  		echo '<td>'. $result->ENDDATE.'</td>';
				  		$d1 =date_create($result->STARTDATE);
				  		$d2 = date_create($result->ENDDATE);
				  		$diff =  date_diff($d1, $d2);
				  		echo '<td>'. $diff->format("%R%a days").'</td>';
						echo '<td>'.  number_format($result->PROJECTCOST,2).'</td>';
						echo '<td>'. number_format($result->PROJECTEXPENSES,2).'</td>';
						echo '<td>'. number_format($result->PROJECTCASHADVANCE,2).'</td>';
						$cost = $result->PROJECTCOST;
						$exp  = $result->PROJECTEXPENSES;
						$cashadd  = $result->PROJECTCASHADVANCE;
						$remFund = $cost - $exp - $cashadd; 
						echo '<td>'. number_format($remFund,2) .'</td>';

						if ($result->PROJECTSTATUS == 'ONGOING') {
							echo '<td ><a class="btn btn-info btn-sm">Ongoing</a></td>';
						}elseif ($result->PROJECTSTATUS == 'FINISHED') {
							echo '<td ><a class="btn btn-success btn-xs">Finished</a></td>';
						}

						
				  		echo '<td align="center" > 

				  			<a title="Edit" href="index.php?view=edit&id='.$result->PROJECTID.'"  class="btn btn-primary btn-sm  ">  <span class="fa fa-edit fw-fa"></span></a>
				  			<a title="Assign Defaults" href="controller.php?action=default&id='.$result->PROJECTID.'"  class="btn btn-primary btn-sm  ">  <span class="fa fa-tags"></span></a>
							<a title="Manage Expenses" href="index.php?view=view&id='.$result->PROJECTID.'"  class="btn btn-primary btn-sm  ">  <span class="fa fa-search fw-fa"></span></a>
							<a title="Print" href="print.php?id='.$result->PROJECTID.'"  class="btn btn-primary btn-sm  ">  <span class="fa fa-print fw-fa"></span></a>

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
      <script type="text/javascript" language="javascript">
      	$(document).ready(function() {
    var table = $('#dataTable').DataTable();
     
    $('#dataTable tbody')
        .on( 'mouseenter', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            $( table.cells().nodes() ).removeClass( 'highlight' );
            $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
        } );
} );
      </script>