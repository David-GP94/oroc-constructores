<?php
    require_once("../../config/conexion.php");
    if (isset($_SESSION["usu_id"])) {
?>
        <!DOCTYPE html>
        <html>
            <?php require_once("../MainHead/head.php"); ?>
            <title>Exitus Credit Help-Desk-Mantenimiento Usuario</title>

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
                                        <h3>Mantenimiento Usuario</h3></h3>
                                        <ol class="breadcrumb breadcrumb-simple">
                                            <li><a href="../Home/">Inicio</a></li>
                                            <li><a href="#">Mantenimiento Usuario</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="box-typical box-typical-padding">
                            <button type="button" id="btn-nuevo"class="btn btn-inline btn-primary">Nuevo Usuario</button>
                            <table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dateTable-full">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">Nombre de Usuario</th>
                                        <th class="d-none d-sm-table-cell" style="width: 40%;">Apellidos</th>
                                        <th class="d-none d-sm-table-cell" style="width: 5%;">Correo</th>
                                        <th style="width: 10%;">Contraseña</th>
                                        <th  class="text-center" style="width: 5%;">Rol</th>
                                        <th  class="text-center" style="width: 5%;"></th>
                                        <th  class="text-center" style="width: 5%;"></th>

                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div><!--.container-fluid-->
                </div><!--.page-content-->
                <!-- Contenido -->
                <?php require_once("modal-usuario.php"); ?>
                <?php require_once("../MainJs/js.php"); ?>
                
                <script type="text/javascript" src="mntusuario.js"></script>
            </body>
        </html>
<?php
    } else{
        header("Location:".Conectar::ruta()."index.php");
    }
?>