<?php
$ErrorForm = null;
$ErrorType = null;
$PatternCharacters = "/^[a-c]/";
$ReplaceCharacters = "";
$AccountCreated = false;

/* 	signo de intercalaci�n - acento circunflejo 
*	DEC 94 
*	HEX 5E 
*	simbolo ^ 
*	Numero &#94;
*/

if($_SESSION["user_type"] == 'registred') header("location:".RAIZ);

if(isset($_POST["nombre"])){
	if(empty($_POST["nombre"])){
		$ErrorForm = "Ingrese un nombre por favor";
		$ErrorType = 'nombre';
	}elseif(strlen($_POST["nombre"]) <= 1){
		$ErrorForm = "El nombre es demasiado corto.";
		$ErrorType = "nombre";
	}elseif(empty($_POST["usr"])){
		$ErrorForm = "Ingresa un nombre de usuario"; 
		$ErrorType = 'usr';
	// }elseif(preg_match($PatternCharacters,$_POST["nombre"])){
		// $ErrorForm = "Por favor use solamente caracteres alfanumericos.";
		// $ErrorType = "usr";
	}elseif(empty($_POST["correo"])){
		$ErrorForm = "Ingrese un correo"; 
		$ErrorType = 'correo';
	}elseif(filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL) == false){
		$ErrorForm = "Correo invalido, ingrese uno weno";
		$ErrorType = 'correo';
	}elseif(empty($_POST["correo2"])){
		$ErrorForm = "Repita el correo por favor.";
		$ErrorType = 'correo2';
	}elseif(filter_var($_POST["correo2"], FILTER_VALIDATE_EMAIL) == false){
		$ErrorForm = "Correo 2 invalido, ingrese uno weno";
		$ErrorType = 'correo2';
	}elseif(strtolower($_POST["correo"]) != strtolower($_POST["correo2"])){
		$ErrorForm = "Los correos ingresados no coinciden";
		$ErrorType = 'correos';
	}elseif(empty($_POST["pass"])){
		$ErrorForm = "Ingrese una contrase&ntilde;a por favor";
		$ErrorType = 'pass';
	}elseif(empty($_POST["pass2"])){
		$ErrorForm = "Repita la contrase&ntilde;a por favor";
		$ErrorType = 'pass2';
	}elseif($_POST["pass"] !== $_POST["pass2"]){
		$ErrorForm = "Las contrase&ntilde;as ingresadas no coinciden";
		$ErrorType = 'passes';
	}else{
		// print_r($_POST);
		
		$u = $usr->verificar_user($_POST["usr"]);
		$c = $usr->verificar_correo($_POST["correo"]);
		
		/*if($u == 1){
			$ErrorForm = "Este usuario ya est&aacute; registrado. no eres tu? <a href='login'>Inicia sesi&oacute;n</a>";
			$ErrorType = "usr";
		}
		
		if($c == 1){
			$ErrorForm = "El correo ya existe.";
			$ErrorType = "correos";
		}
		
		if($c = 1 && $u == 1){
			$ErrorForm = "El correo y usuario ya est&aacute;n registrado. no eres tu? <a href='login'>Inicia sesi&oacute;n</a>";
			$ErrorType = "correos";
		}
		
		
		echo $u."<br />";
		echo $c;
		*/

		if($u == 1){
			$ErrorForm = "El usuario ya se encuentra registrado.";
			$ErrorType = "usr";
		}elseif($c == 1){
			$ErrorForm = "El correo ya est� asociado a un usuario registrado.";
			$ErrorType = "correo";
		}elseif($u == 0 && $c == 0){
			$NewUserId = $usr->registrar_usuario();
			if($NewUserId){
				$AccountCreated = true;
			}		
		}
	}
}else{
	$_POST = NULL;
	$AccountCreated = false;
	//$NewUserId = 3;
}



?>
<div id="Wrapper-registro">
	<div class="clear"></div>
	<?php
		if($AccountCreated == true){
			?>
				<div class="Register-mensaje-status">
					<h1>
						Su cuenta ha sido creada
					</h1>
					<p>
						Dirigase a la bandeja de entrada del correo electronico que ha ingresado para el registro <br /> recibir&aacute; los pasos para validar su cuenta en aaaimage.
					</p>
					
					<p>
						<a href="activar/<?php echo MD5($NewUserId)."/".SHA1($_SERVER["REMOTE_ADDR"]); ?>" target="_BLANK">Activar mi fucking cuenta</a>
					</p>
				</div>
			<?php
		}else{

		if(isset($ErrorForm)){
			?>
				<div class="Register-error shadow-two">
					<p><?php echo $ErrorForm; ?></p>
				</div>
			<?php
		}
	?>
	<div id="form-registro" class="left">
		<form action="registro" id="formulario_registro" method="POST">
			<table colspan="0">
				<tr  align="center">
					<td colspan="2"><h1 style="margin-bottom:15px;">Registrate, es f&aacute;cil!</h1></td>
				</tr>
				<tr>
					<td><label for="nombre">Nombres : </label></td>
					<td>
						<div class="Wrapper-text shadow-two">
							<input type="text" name="nombre" id="nombre" autocomplete="off" value="<?php echo htmlspecialchars($_POST["nombre"], ENT_QUOTES) ?>" maxlength="255" />
						</div>
						<i class="icon_24 <?php if($ErrorType == 'nombre') echo "WrongIcon_24"; ?>" <?php if($_POST["nombre"]) echo 'style="display:block;"'; ?>></i>
					</td>
				</tr>
				<tr>
					<td><label for="usr">Usuario : </label></td>
					<td>
						<div class="Wrapper-text shadow-two">
							<input type="text" name="usr" id="usr" autocomplete="off" value="<?php echo htmlspecialchars($_POST["usr"], ENT_QUOTES) ?>" maxlength="16"/>
						</div>
						<i class="icon_24 <?php if($ErrorType == 'usr') echo "WrongIcon_24" ?>" <?php if($_POST["usr"]) echo 'style="display:block;"'; ?>></i>
					</td>
				</tr>
				<tr>
					<td><label for="correo">Correo : </label></td>
					<td>
						<div class="Wrapper-text shadow-two">
							<input type="text" name="correo" id="correo" autocomplete="off" value="<?php echo htmlspecialchars(strtolower($_POST["correo"]), ENT_QUOTES) ?>" maxlength="255"/>
						</div>
						<i class="icon_24 <?php if($ErrorType == 'correo' || $ErrorType == 'correos') echo "WrongIcon_24" ?>" <?php if($_POST["correo"]) echo 'style="display:block;"'; ?>></i>
					</td>
				</tr>
				<tr>
					<td><label for="correo2">Repite el correo : </label></td>
					<td>
						<div class="Wrapper-text shadow-two">
							<input type="text" name="correo2" id="correo2" autocomplete="off" value="<?php echo htmlspecialchars(strtolower($_POST["correo2"]), ENT_QUOTES) ?>" maxlength="255"/>
						</div>
						<i class="icon_24 <?php if($ErrorType == 'correo2' || $ErrorType == 'correos') echo "WrongIcon_24" ?>" <?php if($_POST["correo2"]) echo 'style="display:block;"'; ?>></i>
					</td>
				</tr>
				<tr>
					<td><label for="pass">Contrase&ntilde;a : </label></td>
					<td>
						<div class="Wrapper-text shadow-two">
							<input type="password" name="pass" id="pass" value="<?php echo htmlspecialchars($_POST["pass"], ENT_QUOTES) ?>" maxlength="16"/>
						</div>
						<i class="icon_24 <?php if($ErrorType == 'pass' || $ErrorType == 'passes') echo "WrongIcon_24" ?>" <?php if($_POST["pass"]) echo 'style="display:block;"'; ?>></i>
					</td>
				</tr>
				<tr>
					<td><label for="pass2">Repite la contrase&ntilde;a : </label></td>
					<td>
						<div class="Wrapper-text shadow-two">
							<input type="password" name="pass2" id="pass2" value="<?php echo htmlspecialchars($_POST["pass2"], ENT_QUOTES) ?>" maxlength="16"/>
						</div>
						<i class="icon_24 <?php if($ErrorType == 'pass2' || $ErrorType == 'passes') echo "WrongIcon_24" ?>" <?php if($_POST["pass2"]) echo 'style="display:block;"'; ?>></i>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="btn BtnBlue rounded-2 shadow-one left" style="left:200px;">
							<input type="submit" value="Registrarme!" />
						</div>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="WhyRegisterMe" class="right">
		<h1>Pero, porqu&eacute; registrarme?</h1>
		<ul>
			<li>hola</li>
			<li>hola</li>
			<li>hola</li>
			<li>hola</li>
		</ul>
	</div>
	<?php
	}
	?>
	<div class="clear"></div>
</div>
<script type="text/javascript" language="javascript">
	function ChangeIcon(id){
		$(id).parents('td').find('i').toggleClass('WrongIcon');
	}
	
	$(function(){
		<?php if(isset($ErrorType)) echo "$('#".$ErrorType."').focus().parent('div').addClass('Wrapper-text-click');"; else echo "$('#nombre').focus().parent('div').addClass('Wrapper-text-click');"; ?>
		
		
		
	});
</script>
