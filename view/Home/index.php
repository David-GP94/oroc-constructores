<?php
    require_once("../../config/conexion.php");
    if (isset($_SESSION["usu_id"])) {
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php"); ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <title>Exitus Credit Help-Desk-Inicio</title>

    <body class="with-side-menu">
        <?php require_once("../MainHeader/header.php"); ?>

        <div class="mobile-menu-left-overlay"></div>
        <?php require_once("../MainNav/nav.php"); ?>

        <!-- Contenido -->
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                   <div class="col-xl-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <article class="statistic-box green">
                                    <div>
                                        <div class="number" id="lbltotal"></div>
                                        <div class="caption" >Total de Tickets</div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-sm-4">
                                <article class="statistic-box yellow">
                                    <div>
                                        <div class="number" id="lbltotalabiertos"></div>
                                        <div class="caption" >Total de Tickets Abiertos</div>
                                    </div>
                                </article>
                            </div>
                            <div class="col-sm-4">
                                <article class="statistic-box red">
                                    <div>
                                        <div class="number" id="lbltotalcerrados"></div>
                                        <div class="caption" >Total de Tickets Cerrados</div>
                                    </div>
                                </article>
                            </div>
                        </div>
                   </div> 
                   <div id="myfirstchart" style="height: 250px;"></div>
                </div>
            </div><!--.container-fluid-->
        </div><!--.page-content-->
        <!-- Contenido -->
        
        <?php require_once("../MainJs/js.php"); ?>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>  
        <script type="text/javascript" src="home.js"></script>  
    </body>
</html>
<?php
    } else{
        header("Location:".Conectar::ruta()."index.php");
    }
?>