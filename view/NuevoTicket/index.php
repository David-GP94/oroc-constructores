<?php
    require_once("../../config/conexion.php");
    if (isset($_SESSION["usu_id"])) {
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php"); ?>
    <title>Exitus Credit Help-Desk-Nuevo Ticket</title>
    <link rel="stylesheet" href="../../public/css/main.css">

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
                                <h3>Nuevo Ticket</h3></h3>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="../Home">Inicio</a></li>
                                    <li><a href="#">Nuevo Ticket</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="box-typical box-typical-padding">
                    <p>
                        Envíar un Ticket
                    </p>
                    <div class="row">
                        <form  method="post" id="ticket_form">
                            <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInputEmail1">Asunto</label>
                                    <input type="text" class="form-control" id="ticket_titulo" name="ticket_titulo" placeholder="Ingrese el asunto">
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInput">¿Que Necesitas?</label>
                                    <select id="cat_id" name="cat_id" class="form-control" onchange="GetCombo2()">
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 hidde" id="combo_2">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInput">Categoria</label>
                                    <select id="cat_id_2" name="cat_id_2" class="form-control" onchange="GetCombo3()">
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 hidde" id="combo_3">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInput">Subcategoria</label>
                                    <select id="cat_id_3" name="cat_id_3" class="form-control" onchange="GetCombo4()">
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 hidde" id="combo_4">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInput">Elemento</label>
                                    <select id="cat_id_4" name="cat_id_4" class="form-control">
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-6" id="#">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInput">Documentos Adicionales</label>
                                   <input type="file" name="fileElem" id="fileElem" class="form-control" multiple>
                                    </select>
                                </fieldset>
                            </div>
                            
                            
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInputPassword1">Descripción</label>
                                    <div class="summernote-theme-1">
                                        <textarea class="summernote" id="ticket_desc" name="ticket_desc"></textarea>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                            <button type="submit" name="action" value="add" class="btn btn-rounded">Guardar</button>
                            </div>
                        </form>
                    </div><!--.row-->
                </div> <!-- box typical -->
            </div><!--.container-fluid-->
        </div><!--.page-content-->
        <!-- Contenido -->
        
        <?php require_once("../MainJs/js.php"); ?>
        <script type="text/javascript" src="nuevoticket.js"></script>
    </body>
</html>
<?php
    } else{
        header("Location:".Conectar::ruta()."index.php");
    }
?>