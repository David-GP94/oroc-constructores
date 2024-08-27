<?php
    require_once("../../config/conexion.php");
    if (isset($_SESSION["user_id"])) {
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php"); ?>
    <title>Oroc Contructores-Nómina</title>
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
                                <h3>Nuevo Registro</h3></h3>
                                <ol class="breadcrumb breadcrumb-simple">
                                    <li><a href="../RegistroNomina">Registro Nómina</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="box-typical box-typical-padding">
                    <p>
                        Envíar un Nuevo Registro
                    </p>
                    <div class="row">
                        <form  method="post" id="ticket_form">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInputEmail1">Responsable</label>
                                    <input type="text" class="form-control" id="ticket_titulo" name="ticket_titulo" placeholder="Ingrese el asunto">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInputEmail1">Fecha</label>
                                    <input type="text" class="form-control" id="ticket_titulo" name="ticket_titulo" placeholder="Ingrese el asunto">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInputEmail1">Obra</label>
                                    <input type="text" class="form-control" id="ticket_titulo" name="ticket_titulo" placeholder="Ingrese el asunto">
                                </fieldset>
                            </div>
                            <table class="table table-bordered table-striped table-vcenter js-dateTable-full">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Sueldo</th>
                                        <th>Horas Extras</th>
                                        <th>Sábado/Domingo</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaCuerpo">
                                    <tr>
                                        <td><input type="text" name="nombre[]"></td>
                                        <td>
                                            <select name="categoria[]">
                                                <option value="Carpintero">Carpintero</option>
                                                <option value="Herrero">Herrero</option>
                                                <option value="Otros">Otros</option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="sueldo[]" oninput="calcularTotal(this); calcularTotalGeneral()"></td>
                                        <td><input type="number" name="horas_extras[]" oninput="calcularTotal(this); calcularTotalGeneral()"></td>
                                        <td><input type="number" name="sabado_domingo[]" oninput="calcularTotal(this); calcularTotalGeneral()"></td>
                                        <td><input type="number" name="total[]" readonly></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">Total General:</td>
                                        <td><input type="number" id="totalGeneral" readonly></td>
                                    </tr>
                                </tfoot>
                                
                            </table>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-primary" onclick="agregarFila()">Agregar Fila</button>
                            </div>
                            <br>
                            <br>
                            <br>
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
        <script type="text/javascript" src="registronomina.js"></script>
    </body>
</html>
<?php
    } else{
        header("Location:".Conectar::ruta()."index.php");
    }
?>