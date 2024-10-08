<header class="site-header">
	    <div class="container-fluid">
	
             <div class="page-center-in__logo">
                <img class="img-logo" src="public/img/logo-oroc.png" alt="">
            </div>
	        <a href="../RegistroNomina/" class="site-logo">
	            <img class="hidden-md-down" src="../../public/img/logo-oroc.png" alt="">
	        </a>
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    <div class="dropdown dropdown-notification notif">
	                        
	                    </div>
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="../../public/img/<?php echo $_SESSION["user_role"] ?>.png" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Ayuda</a>
	                            <div class="dropdown-divider"></div>
	                            <a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesión</a>
	                        </div>
	                    </div>
	
	                <div class="mobile-menu-right-overlay"></div>

            <input type="hidden" id="user_id" value="<?php echo $_SESSION["user_id"] ?>"> <!--Id del Usuario !-->
            <input type="hidden" id="user_role" value="<?php echo $_SESSION["user_role"] ?>"> <!--Rol del Usuario !-->
                    
            <div class="dropdown dropdown-typical">
                <a href="#" class="dropdown-toggle no-arr">
                    <span class="font-icon font-icon-user"></span>
                    <span class="lblcontactonomx"><?php echo $_SESSION["user_names"] ?> <?php echo $_SESSION["user_last_name"] ?></span>
                </a>
            </div>
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->