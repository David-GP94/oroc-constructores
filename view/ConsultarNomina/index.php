<?php
    require_once("../../config/conexion.php");
    if (isset($_SESSION["user_id"])) {
?>
        <!DOCTYPE html>
        <html>
            <?php require_once("../MainHead/head.php"); ?>
            <title>Oroc Contructores-Nómina</title>

            <body class="with-side-menu">
                <?php require_once("../MainHeader/header.php"); ?>

                <div class="mobile-menu-left-overlay"></div>
                <?php require_once("../MainNav/nav.php"); ?>

                <!-- Contenido -->
                <div class="page-content">
                    <div class="container-fluid">
                        <header class="section-header">
                            <div class="tbl">
                                <div class="tbl-row">
                                    <div class="tbl-cell">
                                        <h3>Consultar Ticket</h3></h3>
                                        <ol class="breadcrumb breadcrumb-simple">
                                            <li><a href="../Home">Inicio</a></li>
                                            <li><a href="#">Consultar Ticket</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="box-typical box-typical-padding">
                            <table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dateTable-full">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">Id Ticket</th>
                                        <!--<th style="width: 15%;">Categoria</th> !-->
                                        <th class="d-none d-sm-table-cell" style="width: 40%;">Titulo</th>
                                        <th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
                                        <th style="width: 10%;">Fecha de Creación</th>
                                        <th style="width: 10%;">Fecha de Asignación</th>
                                        <th style="width: 10%;">Agente</th>
                                        <th  class="text-center" style="width: 5%;">Ver Detalle</th>

                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div><!--.container-fluid-->
                </div><!--.page-content-->
                <!-- Contenido -->
                <?php require_once("modal-asignar.php"); ?>
                <?php require_once("../MainJs/js.php"); ?>
                
                <script type="text/javascript" src="consultarnomina.js"></script>
            </body>
        </html>
<?php
    } else{
        header("Location:".Conectar::ruta()."index.php");
    }
?>