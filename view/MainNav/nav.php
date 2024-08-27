<?php if ($_SESSION["user_role"] == 1) { //Rol Soporte ?>
    <nav class="side-menu">
	    <ul class="side-menu-list">
            <li class="red-dirty">
	            <a href="..\RegistroNomina\">
                    <span class="glyphicon glyphicon-th"></span>
                    <span class="lbl">Registro Nómina</span>
                </a>
	        </li>
	    </ul>    
    </nav><!--.side-menu-->
<?php } else { ?>
    <nav class="side-menu">
	    <ul class="side-menu-list">
            <li class="blue-dirty">
                <a href="..\RegistroNomina\">
                    <span class="glyphicon glyphicon-th"></span>
                    <span class="lbl">Registro Nómina</span>
                </a>
	        </li>
           
            <li class="blue-dirty">
	            <a href="..\ConsultarNomina\">
                    <span class="glyphicon glyphicon-th"></span>
                    <span class="lbl">Consultar Nómina</span>
                </a>
	        </li>
	    </ul>    
    </nav><!--.side-menu-->
<?php }  ?>