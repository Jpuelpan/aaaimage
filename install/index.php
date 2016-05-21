<?php
$dir = explode("/",getcwd());
$raiz_padre = $dir[count($dir) - 2];
($_SERVER['SERVER_NAME'] == 'localhost') ? define('RAIZ' , 'http://localhost/'.$raiz_padre) : define('RAIZ' , 'http://'.$_SERVER['SERVER_NAME']) ;

if(isset($_POST["MYSQLUSER"])){
	if(empty($_POST["MYSQLHOST"])){
		$error = "Ingresa el host MySQL";
	}elseif(empty($_POST["MYSQLUSER"])){
		$error = "Ingresa un nombre de usuario para ".$_POST["MYSQLHOST"]."";
	}elseif(empty($_POST["MYSQLDB"])){
		$error = "Ingresa el nombre de la Base de datos";
	}else{	
		$c = @mysql_connect($_POST["MYSQLHOST"],$_POST["MYSQLUSER"],$_POST["MYSQLPASS"]) or $error = mysql_error();
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($_POST["MYSQLDB"]) or $error = mysql_error();
		
		if(!isset($error)){
			$file_cfg = "<?php\n"
			."define('MYSQL_HOST' , '".$_POST["MYSQLHOST"]."');\n"
			."define('MYSQL_USER' , '".$_POST["MYSQLUSER"]."');\n"
			."define('MYSQL_PASS' , '".$_POST["MYSQLPASS"]."');\n"
			."define('MYSQL_DB' , '".$_POST["MYSQLDB"]."');\n"
			.'($_SERVER["SERVER_NAME"] == "localhost") ? define("RAIZ" , "http://localhost/'.$raiz_padre.'") : define("RAIZ" , "http://".$_SERVER["SERVER_NAME"]);'
			."\n?>";
			
			$config = fopen("../config.php","w+");
			if($config == false ) die("No se pudo crear config.php");
			$write = fwrite($config,$file_cfg);
			if($write == false) die("No se pudo escribir config.php");
			
			$gestor = @fopen("db.sql", "r");
			if ($gestor) {
				while (($buffer = fgets($gestor)) !== false) {
					$op[] = $buffer;
				}
				if (!feof($gestor)) {
					echo "Error: fallo inesperado de fgets()\n";
				}
				fclose($gestor);
			}
			
			foreach(explode(";",implode($op)) as $sql){
				mysql_query($sql,$c);
			}
			
			$ok = "<h1>Instalaci&oacute;n completa</h1> <p>por favor elimine la carpeta install por razones de seguridad <br /> <a href='".RAIZ."'>Ir al inicio</a></p>";
		}
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Instalaci&oacute;n de aaaimage</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
	<div id="container">
		<div id="central-box" class="left">
			<i id="logo" style="background:url(<?php echo RAIZ.'/img/logo.png' ?>) no-repeat;"></i>
			
			<?php
				if(isset($error)){
					?>
					<div id="error">
						<p><?php echo $error ?></p>
					</div>
					<?php
				}
				
				if(isset($ok)){
					?>
					<div id="ok">
						<?php echo $ok ?>
					</div>
					<?php
				}elseif(file_exists('../config.php')){
					?>
					<div id="ok">
						<h1>Wops!</h1>
						<p>La aplicacion ya esta instalada <br /> por favor elimine la carpeta install por razones de seguridad.</p>
					</div>
					<?php
				}else{
				
			?>
			<h1 style="margin-top:20px;">Instalaci&oacute;n</h1>
			<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
				<table width="300">
					<tr>
						<td>Host Mysql : </td>
						<td> <input type="text" name="MYSQLHOST" value="<?php if($_SERVER["SERVER_NAME"] == 'localhost') echo "localhost"; ?>" /> </td>
					</tr>
					<tr>
						<td>Usuario Mysql : </td>
						<td> <input type="text" name="MYSQLUSER" value="<?php if(isset($_POST["MYSQLUSER"])) echo $_POST["MYSQLUSER"] ?>" /> </td>
					</tr>
					<tr>
						<td>Password Mysql : </td>
						<td> <input type="password" name="MYSQLPASS" /> </td>
					</tr>
					<tr>
						<td>Base de datos : </td>
						<td> <input type="text" name="MYSQLDB" value="<?php if(isset($_POST["MYSQLDB"])) echo $_POST["MYSQLDB"] ?>" /> </td>
					</tr>
					<tr>
						<td colspan="2" align="center"> <input type="submit" value="Instalar!" class="buttonok" /> </td>
					</tr>
				</table>
			</form>
			<?php } ?>
		</div>
		<div class="clear"></div>
	</div>
</body>
</html>
