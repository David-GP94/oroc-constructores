<?php
    require_once("config/conexion.php");
    if (isset($_POST["enviar"]) and $_POST["enviar"] == "si") {
        require_once("models/usuario.php");
        $usuario = new Usuario();
        $usuario->login();
    }
?>
<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Oroc Contructores-Nómina</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="page-center-in__logo">
                <img class="img-logo" src="public/img/logo-oroc.png" alt="">
            </div>
            <div class="container-fluid">
                <form class="sign-box" action="" method="post" id="login_form">
                    <input type="hidden" id="user_role" name="user_role" value="1">
                    <div class="sign-avatar">
                        <img src="public/img/1.png" alt="" id="img-profile">
                    </div>
                    <header class="sign-title" id="lbltitulo">Acceso Usuario</header>
                    <?php
                        if (isset($_GET["m"])) {
                            switch ($_GET["m"]) {
                                case '1':
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                            <span>El usuario y/o Contraseña son incorrectos.</span>
                                        </div>
                                    </div>
                                <?php
                                    
                                break;
                                case '2':
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                            <span>Los campos estan vacios.</span>
                                        </div>
                                    </div>
                                <?php
                                break;
                            }
                        }
                    ?>
                    <div class="form-group">
                        <input type="text" id="user_username" name="user_username" class="form-control" placeholder="E-Mail"/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="user_password" name="user_password" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                    </div>
                    <input type="hidden" name="enviar" class="form-control" value="si">
                    <button type="submit" class="btn btn-rounded">Acceder</button>
                    <!--<button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>-->
                </form>
            </div>
        </div>
    </div><!--.page-center-->


<script src="public/js/lib/jquery/jquery.min.js"></script>
<script src="public/js/lib/tether/tether.min.js"></script>
<script src="public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="public/js/plugins.js"></script>
    <script type="text/javascript" src="public/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="public/js/app.js"></script>
<script type="text/javascript" src="index.js"></script>
</body>
</html>