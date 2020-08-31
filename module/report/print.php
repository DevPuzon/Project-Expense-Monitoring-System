<?php
 error_reporting(0);
require_once("../../include/initialize.php");
 
$dtFrom = $_GET['dtFrom'];
$dtTo = $_GET['dtTo'];


?>

<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    #tableInfo {
        border: 1px solid black;
    }
</style>
<?php
$projectId = $_GET['PROJECTID'];
global $mydb;
$statementexp = "SELECT  * FROM tblproject WHERE PROJECTID = '$projectId'";
$mydb->setQuery($statementexp);
$cur = $mydb->loadResultList();
foreach ($cur as $project_row) {
    ?>
    <div class="row">

        <div class="col-lg-12">
            <div class="card mb-3">

                <div class="card-body">
                    <div class="table-responsive">

                        <form action="" Method="POST">

                            <table class="table table-bordered " id="tableInfo" width="100%"
                                   style="border: 1px solid black;" cellspacing="0">

                                <thead>
                                <tr>
                                    <th>WEEKLY ACCOMPLISHMENT <br/>
                                        <?= strtoupper($project_row->PROJECTNAME); ?> <br/>
                                        PERIOD COVERED: <?= $_GET['dtFrom'] . ' TO ' . $_GET['dtTo']; ?> <br/>
                                        DATE ACCOMPLISHED <br/>
                                        DATE RELEASED<br/>
										
                            <?='General Total: '. number_format($project_row->PROJECTEXPENSES,2);   ?> <br/>
                            <?='Deductions: '. number_format($project_row->PROJECTCASHADVANCE,2); ?>
                                    </th>
                                </thead>
                            </table>

                            <br/>

                            <?php
                            $amt=0;$tt=0;$CAdetails='';
							$dtFrom= $_GET['dtFrom'];
							$dtTo= $_GET['dtTo'];
							$dtTo = date('Y-m-d', strtotime("+1 day", strtotime($dtTo)));
							$where = " AND a.created_at BETWEEN '$dtFrom' AND '$dtTo'";
							  $where;
                            $sqlCon = "SELECT  ae.AREAID,SCOPE_OF_WORK,TOTAL_AMOUNT,TOTAL_CASH_ADVANCE,CASH_ADVANCE_DETAILS FROM tblareas a  
                             INNER JOIN tblarea_expenses ae ON ae.AREAID=a.AREAID WHERE a.PROJECTID ='$projectId' $where GROUP BY SCOPE_OF_WORK";
                            // echo $sqlCon;
                            $mydb->setQuery($sqlCon);
                            $resCon = $mydb->loadResultList();
                            foreach ($resCon as $sub_con) {
                                $contractWith = strtoupper($sub_con->SCOPE_OF_WORK);
                                echo '-' . $contractWith . '-'; ?>
                                <br/>

                                <?php
$CAdetails='';								$sqlCat = "SELECT  CATEGORY,TOTAL_CASH_ADVANCE,CASH_ADVANCE_DETAILS FROM   tblareas a  
                              INNER JOIN tblarea_expenses ae ON ae.AREAID=a.AREAID WHERE a.PROJECTID ='$projectId' AND SCOPE_OF_WORK='$contractWith'  $where GROUP BY CATEGORY";
                                $mydb->setQuery($sqlCat);
                                $resCat = $mydb->loadResultList();
                                foreach ($resCat as $cat) {
                                    $category = $cat->CATEGORY;
                                    echo '# ' . $category;
                                    echo '<br/>'; ?>

                                    <?php 
									$tt=0;
									$sqlBlk = "SELECT  BLOCK_NO , COALESCE(SUM(TOTAL_EXPENSES),0)ttExp FROM  tblareas a  
                              INNER JOIN tblarea_expenses ae ON ae.AREAID=a.AREAID 
                              WHERE a.PROJECTID ='$projectId' AND SCOPE_OF_WORK='$contractWith' AND CATEGORY='$category' $where GROUP BY BLOCK_NO";
                                //    echo $sqlBlk;
                                   $mydb->setQuery($sqlBlk);
                                    $resBlk = $mydb->loadResultList();
                                        
                                    
                                    $print_table =  "<table> <tr>
                                    <th>Block</th>
                                    <th>Lot</th>
                                    <th>Expenses</th>
                                  </tr>";
                                    foreach ($resBlk as $blk_row) {
                                        $blk = $blk_row->BLOCK_NO; 
                                        $print_table = $print_table. "<tr>
                                          <td>$blk_row->BLOCK_NO</td>
                                         ";

                                         $sqlLot = "SELECT   LOT_NO  FROM  tblareas a  
                              INNER JOIN tblarea_expenses ae ON ae.AREAID=a.AREAID 
                              WHERE a.PROJECTID ='$projectId' AND SCOPE_OF_WORK='$contractWith' AND CATEGORY='$category' $where AND BLOCK_NO='$blk' GROUP BY LOT_NO";
                                            // echo $sqlLot;
                                       $mydb->setQuery($sqlLot);
                                        $resLot = $mydb->loadResultList(); $grandTotal=0; 
                                        foreach ($resLot as $lot_row) { 
                                            $print_table = $print_table. " <td>$lot_row->LOT_NO</td> "; 
                                        }  
                                        // $print_table = $print_table. " <td>we</td> ";
                                       
                                            // $amt=$blk_row->ttExp  . '<br>';
                                            $print_table = $print_table. " 
                                            <td>$blk_row->ttExp</td>
                                          </tr>";
                                            // echo $tt  = $tt + $amt; 
										 $grandTotal += $tt;
                                    }
                                    
                                    $print_table = $print_table. "</table>";
                                    echo $print_table ; ?>
								<?php $CAdetails  =$CAdetails.number_format($cat->TOTAL_CASH_ADVANCE,2).' '.$cat->CASH_ADVANCE_DETAILS.'<br/>';?> 
                                <?php }  
                                
                                $sql  = "SELECT  *,SUM(col_amount) as total_amount FROM tbl_areacashadv a inner join tbl_cashadv b on b.col_id =a.col_cashadv_id WHERE SCOPE_OF_WORK ='$sub_con->SCOPE_OF_WORK' AND col_createdat BETWEEN '$dtFrom' AND '$dtTo'";
                                $print_table = "<br> <table>
                                    <tr>   
                                        <th>Description</th>
                                        <th>amount</th>
                                    </tr> "   ; 
                                // echo $sql;    
                                $mydb->setQuery($sql);
                                $res = $mydb->loadResultList();
                                foreach($res as $result){ 
                                    $print_table = $print_table."
                                    <tr>   
                                        <td>".$result->col_cat."</td>
                                        <td>".$result->col_amount."</td>
                                    </tr>";
                                }
                                echo $print_table."</table>"; 
                                $gtt=number_format($grandTotal+$result->total_amount,2);
                                echo "Total amount: $gtt <br> Received By: ____________________";

                                ?> 
                                <hr/>
                            <?php } ?> <br/>
                         

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

<?php } ?>
<script type="text/javascript">

        //   $(document).ready(function () {
        //        window.print();
        //      }); 

</script>

</body>
</html>
