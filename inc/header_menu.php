<div id="header">
	<div class="Wrap">
		<a href="<?php echo RAIZ ?>" id="logo" class="left" title="aaaImage - Tu Hosting de imagenes"></a>
	</div>
</div>

<div id="menu">
	<div class="Wrap">
		<a href="<?php echo RAIZ ?>" <?php if($this_page == 'index') echo 'class="menu-activo"'; ?> >Inicio</a>
		<a href="javascript:void(0);" <?php if($this_page == 'search') echo 'class="menu-activo"'; ?> >Buscar</a>
		<a href="javascript:void(0);" <?php if($this_page == 'create_gallery') echo 'class="menu-activo"'; ?>>Crear galer&iacute;a</a>
				
		<?php
			if($_SESSION["user_type"] == 'temporal'){ 
		?>
				<a href="<?php echo RAIZ ?>/registro" <?php if($this_page == 'registro') echo 'class="menu-activo"'; ?>>Registrarme!</a>
		<?php 
			}
				
			if($_SESSION["user_type"] != 'temporal'){
				include("menu_usuario.php");
			}
		?>
		</div>
</div>
