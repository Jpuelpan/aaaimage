<?php
($login == true) ? $style = 'style="position:relative;left:35%;"' : $style = null;
?>
<div id="login" class="left" <?php echo $style; ?>>
	<form id="login-form" action="login" method="POST">
		<table cellspacing="0">
			<tr align="center">
				<td colspan="2">
					<h1>Iniciar sesi&oacute;n</h1>
				</td>
			</tr>
			<tr>
				<td>
					<label for="usuario">usuario : </label>
				</td>
				<td>
					<div class="Wrapper-text shadow-two">
						<input type="text" name="usuario" id="usuario" />
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<label for="pass">Contrase&ntilde;a : </label>
				</td>
				<td>
					<div class="Wrapper-text shadow-two">
						<input type="password" name="pass" id="pass" maxlength="16"/>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="btn BtnBlue shadow-one left" style="left:90px;">
						<input type="submit" value="Ingresar" />
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>