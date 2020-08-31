<?php
require_once("../../include/initialize.php");
$projectID = $_GET['id'];
$Project = New Project();
$sProject = $Project->single_project($projectID);

?>

<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-3">

<!--            <div class="card-header">-->
<!--                <i class="fa fa-bar-chart"></i> Project Details --><?//= $projectID; ?>
<!--            </div>-->

            <div class="card-body">
                <form class="form-horizontal span4" action="" method="POST">
                    <table class="table-striped" align="left" width="100%">

                        <tbody>
                        <tr>

                            <td><strong>Project Name</strong></td>
                            <td align="left"> <?php echo (isset($sProject)) ? $sProject->PROJECTNAME : 'Project Name'; ?>
                        <tr>
                            <td><strong>Start Date </strong></td>
                            <td>  <?php echo (isset($sProject)) ? $sProject->STARTDATE : 'Start Date'; ?>
                        <tr>
                            <td><strong>End Date </strong></td>
                            <td> <?php echo (isset($sProject)) ? $sProject->ENDDATE : 'Start Date'; ?>
                        <tr>
                            <td><strong>Project Cost</strong></td>
                            <td> <?php echo (isset($sProject)) ? number_format($sProject->PROJECTCOST, 2) : 'Project Cost'; ?>
                                <?php
                                $cost = $sProject->PROJECTCOST;
                                $exp = $sProject->PROJECTEXPENSES;
                                $remFund = $cost - $exp;
                                ?>

                        <tr>
                            <td><strong>Total Expenses</strong></td>
                            <td> <?php echo (isset($sProject)) ? number_format($sProject->PROJECTEXPENSES, 2) : 'Total Expenses'; ?>
                        <tr>
                            <td><strong>Available Funds</strong></td>
                            <td> <?php echo (isset($sProject)) ? number_format($remFund, 2) : 'Available Funds'; ?><br/>
                        <tr>
                            <td><strong>Project Status</strong></td>
                            <td> <?php echo (isset($sProject)) ? $sProject->PROJECTSTATUS : 'Status'; ?>

                        </tr>
                        </tbody>
                    </table>
                </form>

            </div>
        </div>

    </div>

</div>

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

global $mydb;
$i = 1;
?>
<div class="row">

    <div class="col-lg-12">
        <div class="card mb-3">

            <div class="card-body">
                <div class="table-responsive">

                    <form action="" Method="POST">

                        <?php
                        $mydb->setQuery("select  * FROM tblareas WHERE PROJECTID='$projectID'  ");
                        $result = $mydb->loadResultList();
                        foreach ($result as $row) {
                            $areaID = $row->AREAID; ?>
                            <table class="table-striped" align="left" width="100%">

                                <tbody>
                                <tr>
                                    <td style="background: dodgerblue;color: white"><strong>LOT
                                            : <?= $row->LOT_NO; ?>  </strong></td>
                                    <td style="background: dodgerblue;color: white"><strong>BLOCK_NO : <?= $row->BLOCK_NO; ?>  </strong></td>
                                </tr>
                                </tbody>
                            </table>

                        <?php
                        $mydb->setQuery("select  * FROM tblarea_expenses WHERE  AREAID='$areaID' GROUP BY CATEGORY  ");
                        $res = $mydb->loadResultList();
                        foreach ($res as $r) { $category = $r->CATEGORY ;?>

                            <table class="table-striped" align="left" width="100%">

                                <tbody>
                                <tr>
                                    <td  style="background: blue;color: white;text-align: center"> <strong> <?= $r->CATEGORY; ?>  </strong></td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered " id="tableInfo" width="100%"
                                   style="border: 1px solid black;" cellspacing="0">

                                <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>SCOPE_OF_WORK</th>
                                    <th>PCS</th>
                                    <th>AMOUNT/Pc.</th>
                                    <th>TOTAL AMOUNT</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $mydb->setQuery("select  *,a.AREAID from tblareas a INNER JOIN tblarea_expenses ea ON ea.AREAID=a.AREAID WHERE PROJECTID='$projectID' AND ea.AREAID='$areaID' AND ea.CATEGORY='$category' ");
                                $cur = $mydb->loadResultList();
                                foreach ($cur as $Defaults) {
                                    echo '<tr>';
                                    echo '<td>' . $Defaults->CATEGORY . '</td>';
                                    echo '<td>' . $Defaults->SCOPE_OF_WORK . '</td>';
                                    echo '<td>' . $Defaults->PCS . '</td>';
                                    echo '<td>' . $Defaults->AMOUNT . '</td>';
                                    echo '<td>' . $Defaults->TOTAL_AMOUNT . '</td>';
                                    echo $active = "";
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>


                        <?php } ?>

                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<script type="text/javascript">

        $(document).ready(function () {
            window.print();
        });

</script>

</body>
</html>
