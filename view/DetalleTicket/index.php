<?php
    require_once("../../config/conexion.php");
    if (isset($_SESSION["usu_id"])) {
?>
        <!DOCTYPE html>
        <html>
            <?php require_once("../MainHead/head.php"); ?>
            <title>Exitus Credit Help-Desk-Detalle Ticket</title>

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
                                            <h3 id="lbl-id-ticket"></h3></h3>
                                            <div id="lbl-estado"></div>
                                            <span class="label label-pill label-primary" id="lbl-nom-usuario"></span>
                                            <span class="label label-pill label-default" id="lbl-fecha-creacion"></span>
                                            <ol class="breadcrumb breadcrumb-simple">
                                                <li><a href="../Home">Inicio</a></li>
                                                <li><a href="#">Detalle Ticket</a></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </header>

                            <div class="box-typical box-typical-padding">
                                <div class="row">
                                        <div class="col-lg-6">
                                            <fieldset class="form-group">
                                                <label class="form-label semibold" for="exampleInputEmail1">Asunto</label>
                                                <input type="text" class="form-control" id="ticket_titulo" name="ticket_titulo" readonly>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset class="form-group">
                                                <label class="form-label semibold" for="ticket_desc_read">Descripción</label>
                                                <div class="summernote-theme-1">
                                                    <textarea class="summernote" id="ticket_desc_read" name="ticket_desc_read"></textarea>
                                                </div>
                                            </fieldset>
                                        </div>
                                </div><!--.row-->
                            </div> <!-- box typical -->
                        <section class="activity-line" id="lbl-detalle">
                        </section><!--.activity-line--> 
                        <div class="box-typical box-typical-padding" id="pnl-detalle">
                            <p>Ingrese su duda o consulta</p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset class="form-group">
                                        <label class="form-label semibold" for="ticket_desc">Descripción</label>
                                        <div class="summernote-theme-1">
                                            <textarea class="summernote" id="ticket_desc_resp" name="ticket_desc_resp"></textarea>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                <button type="button" class="btn btn-rounded" id="btn-enviar">Envíar</button>
                                <button type="button" class="btn btn-warning btn-rounded" id="btn-cerrar-ticket">Cerrar Ticket</button>
                                </div>
                            </div><!--.row-->
                        </div> <!-- box typical -->
                    </div><!--.container-fluid-->
                </div><!--.page-content-->
                <!-- Contenido -->
                
                <?php require_once("../MainJs/js.php"); ?>
                
                <script type="text/javascript" src="detalleticket.js"></script>
            </body>
        </html>
<?php
    } else{
        header("Location:".Conectar::ruta()."index.php");
    }
?>