<?php
session_start();
error_reporting(0);
include('includes/config.php');
$error = "";
$msg = "";

if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['apply'])) {
        $empid = $_SESSION['eid']; 
        if (empty($empid)) {
            $error = "Erro de sessão: ID do usuário não encontrado. Tente fazer login novamente.";
        } else {
        $projecttype = $_POST['projecttype'];
        $description = $_POST['description'];
        $status = 0; 
        $isread = 0;

        
        $fromdate_raw = $_POST['fromdate'];  
        $todate_raw = $_POST['todate'];
        
        $fromdate = date("Y-m-d", strtotime(str_replace('/', '-', $fromdate_raw)));
        $todate = date("Y-m-d", strtotime(str_replace('/', '-', $todate_raw)));

        try {
            
            $sql = "INSERT INTO tblprojects(ProjectType, to_date, from_date, Description, Status, IsRead, empid) 
                    VALUES(:projecttype, :todate, :fromdate, :description, :status, :isread, :empid)";
            
            $query = $dbh->prepare($sql);
            $query->bindParam(':projecttype', $projecttype, PDO::PARAM_STR);
            $query->bindParam(':todate', $todate, PDO::PARAM_STR);
            $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
            $query->bindParam(':description', $description, PDO::PARAM_STR);
            $query->bindParam(':status', $status, PDO::PARAM_INT);
            $query->bindParam(':isread', $isread, PDO::PARAM_INT);
            $query->bindParam(':empid', $empid, PDO::PARAM_STR);
            
            if($query->execute()) {
                $lastInsertId = $dbh->lastInsertId();
                
                
                if ($lastInsertId && isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === 0) {
                    $diretorio = "uploads/";
                    if (!is_dir($diretorio)) mkdir($diretorio, 0755, true);
                    
                    $novoNome = uniqid() . "." . pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
                    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novoNome)) {
                        $sqlDoc = "INSERT INTO documentos (nome_original, caminho_arquivo, projeto_id) VALUES (:nom, :cam, :pid)";
                        $qDoc = $dbh->prepare($sqlDoc);
                        $qDoc->bindValue(':nom', $_FILES['arquivo']['name']);
                        $qDoc->bindValue(':cam', $novoNome);
                        $qDoc->bindValue(':pid', $lastInsertId);
                        $qDoc->execute();
                    }
                }
                $msg = "Projeto enviado com sucesso!";
            } else {
                $error = "Erro no envio. Verifique os dados.";
            }
        } catch (PDOException $e) {
            $error = "Erro técnico: " . $e->getMessage();
        }
    }
}


?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>

        <!-- Title -->
        <title>Usuário | Publicar projeto</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>



    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>
        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="page-title">Publicar projeto</div>
                </div>
                <div class="col s12 m12 l8">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="addemp">
                                <div>
                                    <h3>Publicar projeto</h3>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m12">
                                                    <div class="row">
                                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERRO </strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESSO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>


                                                        <div class="input-field col  s12">
                                                            <select name="projecttype" autocomplete="off" required>
                                                                <option value="">Selecione um tipo de projeto</option>
                                                                <?php $sql = "SELECT  ProjectType from tblprojecttype";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                foreach ($results as $result) {   ?>
                                                                        <option value="<?php echo htmlentities($result->ProjectType); ?>"><?php echo htmlentities($result->ProjectType); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>


                                                        <div class="input-field col m6 s12">
                                                            <label for="fromdate">da Data</label>
                                                            <input placeholder="" id="mask1" name="fromdate" class="masked" type="text" data-inputmask="'alias': 'date'" required>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="todate">até a Data</label>
                                                            <input placeholder="" id="mask1" name="todate" class="masked" type="text" data-inputmask="'alias': 'date'" required>
                                                        </div>
                                                        <div class="input-field col m12 s12">
                                                            <label for="birthdate">Descrição</label>

                                                            <textarea id="textarea1" name="description" class="materialize-textarea" length="500" required></textarea>
                                                        </div>
                                                        <div class="input-field col m12 s12">
                                                            <form id="example-form" method="post" name="addemp" enctype="multipart/form-data">
                                                                <div class="input-field col m6 s12">
                                                                    <label>Selecione o documento:</label>
                                                                    <br><br>
                                                                    <input type="file" name="arquivo">
                                                                </div>
                                                                
                                                                <button type="submit" name="apply" id="aplicar" class="waves-effect waves-light btn indigo m-b-xs">Enviar</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                    </section>


                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
        <div class="left-sidebar-hover"></div>

       
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
        <script src="assets/js/pages/form-input-mask.js"></script>
        <script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    </body>

    </html>
<?php } ?>