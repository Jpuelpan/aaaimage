<?php
if(!isset($_GET["id"]) && !isset($_GET["ip"])){
	header("location:".RAIZ);
}

require_once("classes/class.php");
require_once("classes/class.usuario.php");

$usr = new Usuario;
$activated = $usr->activar_usuario();

switch($activated){
	case '1' : $title = "Cuenta actiavada exitosamente - aaaimage"; break;
	case '0' : $title = "Hubo un error al activar la cuenta - aaaimage"; break;
	case 'Activo' : $title = "Su cuenta ya est&aacute; activa"; break;
	case 'Eliminado' : $title = "Su cuenta est&aacute; eliminada"; break; 	
	default : $title = "aaaimge"; break;
}

switch($activated){
	case '0' : $ActivatedMssge = "El link ha caducado, por favor <a href='".RAIZ."/registro'>registrese de nuevo.</a>"; break;
	case '1' : $ActivatedMssge = "Su cuenta ha sido activada exitosamente, ahora <a href='".RAIZ."/login'>Iniciar sesi&oacute;n.</a>"; break;
	case 'Activo' : $ActivatedMssge = "Su cuenta ya se encuentra activada, <a href='".RAIZ."/login'>inicie sesi&oacute;n</a> para acceder a su cuenta"; break;
	case 'Eliminado' : $ActivatedMssge = "Su cuenta ha sido eliminada, por incumplimientos en el <a href='javascript:void(0)'>protocolo.</a>"; break;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	<?php include("head.php"); ?>	
	</head>
<body>
	<!-- Header & Menu -->
	<?php include("header_menu.php"); ?>
	<!-- Fin header & Menu -->

	<!-- Contenedor -->
	<div id="container">
	<?php
		echo '<div class="clear"></div>';
		
		echo "<div id='activated-box'>";
		if(isset($ActivatedMssge)){
			?>
			<div class="Register-mensaje-status">
				<h1><?php echo $title; ?></h1>
				<p><?php echo $ActivatedMssge; ?></p>
			</div>
			<?php
		}
		echo "</div>";
		echo '<div class="clear"></div>';
		
	?>
	</div>
	<!-- Fin contenedor -->
	
	<!-- Footer -->
	<?php include("footer.php"); ?>
	<!-- Fin Footer -->
</body>
</html>
