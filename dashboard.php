<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>

 
        <title>Prefeitura | Dashboard</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="" />

   
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">


        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>

        <main class="mn-inner">
            <div class="">
                <div class="row no-m-t no-m-b">




                    <a href="projecthistory.php" target="blank">
                        <div class="col s12 m12 l4">
                            <div class="card stats-card">
                                <div class="card-content">
                                    <span class="card-title">Total de Projetos</span>
                                    <?php $eid = $_SESSION['eid'];
                                    $sql = "SELECT id from  tblprojects where empid ='$eid'";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $totalprojects = $query->rowCount();
                                    ?>
                                    <span class="stats-counter"><span class="counter"><?php echo htmlentities($totalprojects); ?></span></span>

                                </div>
                                <div class="progress stats-card-progress">
                                    <div class="success" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="projecthistory.php" target="blank">
                        <div class="col s12 m12 l4">
                            <div class="card stats-card">
                                <div class="card-content">
                                    <span class="card-title">Projetos Concluidos</span>
                                    <?php
                                    $sql = "SELECT id from  tblprojects where Status=1 and empid ='$eid'";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $approvedprojects = $query->rowCount();
                                    ?>
                                    <span class="stats-counter"><span class="counter"><?php echo htmlentities($approvedprojects); ?></span></span>

                                </div>
                                <div class="progress stats-card-progress">
                                    <div class="success" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </a>



                    <a href="projecthistory.php" target="blank">
                        <div class="col s12 m12 l4">
                            <div class="card stats-card">
                                <div class="card-content">
                                    <span class="card-title">Novas aplicações de Projetos</span>
                                    <?php
                                    $sql = "SELECT id from  tblprojects where Status=0 and empid ='$eid'";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $approvedprojects = $query->rowCount();
                                    ?>
                                    <span class="stats-counter"><span class="counter"><?php echo htmlentities($approvedprojects); ?></span></span>

                                </div>
                                <div class="progress stats-card-progress">
                                    <div class="success" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </a>









                </div>

                <div class="row no-m-t no-m-b">
                    <div class="col s15 m12 l12">
                        <div class="card invoices-card">
                            <div class="card-content">

                                <span class="card-title">Últimas aplicações de Projetos</span>
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="200">Nome do Usuário</th>
                                            <th width="120">Tipo de Projeto</th>
                                            <th width="180">Data postada</th>
                                            <th>Status</th>
                                            <th align="center">Ação</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $sql = "SELECT tblprojects.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblprojects.ProjectType,tblprojects.PostingDate,tblprojects.Status from tblprojects join tblemployees on tblprojects.empid=tblemployees.id where tblprojects.empid='$eid' order by lid desc limit 6";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                        ?>

                                                <tr>
                                                    <td> <b><?php echo htmlentities($cnt); ?></b></td>
                                                    <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id); ?>" target="_blank"><?php echo htmlentities($result->FirstName . " " . $result->LastName); ?>(<?php echo htmlentities($result->EmpId); ?>)</a></td>
                                                    <td><?php echo htmlentities($result->projectType); ?></td>
                                                    <td><?php echo htmlentities($result->PostingDate); ?></td>
                                                    <td><?php $stats = $result->Status;
                                                        if ($stats == 1) {
                                                        ?>
                                                            <span style="color: green">Concluido</span>
                                                        <?php }
                                                        if ($stats == 2) { ?>
                                                            <span style="color: red">Congelado</span>
                                                        <?php }
                                                        if ($stats == 0) { ?>
                                                            <span style="color: blue">Em Andamento</span>
                                                        <?php } ?>


                                                    </td>

                                                    <td>
                                                    <td><a href="project-details.php?projectid=<?php echo htmlentities($result->lid); ?>" class="waves-effect waves-light btn blue m-b-xs"> Ver Detalhes</a></td>
                                                </tr>
                                        <?php $cnt++;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        </div>



        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/plugins/chart.js/chart.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/dashboard.js"></script>

    </body>

    </html>
<?php } ?>