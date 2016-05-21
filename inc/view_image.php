<?php
if($imagen['error'] == true){
	$img->error($imagen['text']);
	include("rand_images.php");
	return false;
}

if($imagen["status"] == 'eliminada'){
	if(isset($_SESSION["user_rango"]) && ($_SESSION["user_rango"] == 'Admin' || $_SESSION["user_rango"] == 'Moderador')){
		
	}else{
		$img->error('La imagen no ha sido encontrada');
		include("rand_images.php");
		return false;
	}
}


$IdCode = SHA1($imagen['id_img']);


?>
<div id="image" class="left" style="height:<?php echo $imagen["height_res"] ?>px;">
	<img src="<?php echo RAIZ.'/'.$imagen["res"]; ?>" alt="" />
</div>
<div id="image-info" class="right">
	<table>
		<tr>
			<td>
				<label for="link-bbcode">Enlace en BBcode</label>
			</td>
		</tr>
		<tr>
			<td>
				<div class="Wrapper-text input-link left">
					<input type="text" id="link-bbcode" class="link-input" value="[img=<?php echo RAIZ."/".$imagen["img"]; ?>]" />
				</div>
				<div class="btn-link-copy right">
					<i class="icon_24 right"></i>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="link-direct">Enlace directo</label>
			</td>
		</tr>
		<tr>
			<td>
				<div class="Wrapper-text input-link left">
					<input type="text" id="link-direct" class="link-input" value="<?php echo RAIZ.'/'.$imagen['img'] ?>" />
				</div>
				<div class="btn-link-copy right">
					<i class="icon_24 right"></i>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="link-thn">Enlace miniatura</label>
			</td>
		</tr>
		<tr>
			<td>
				<div class="Wrapper-text input-link left">
					<input type="text" id="link-thn" class="link-input" value="<?php echo RAIZ.'/'.$imagen['thn'] ?>" />
				</div>
				<div class="btn-link-copy right">
					<i class="icon_24 right"></i>
				</div>
			</td>
		</tr>
	</table>
	
	<div class="separator" style="margin-top:10px; margin-bottom:10px;"></div>
	
	<div id="datos-imagen">
		<a title="Tipo de imagen"><?php echo $imagen["tipo"]; ?></a>
		<a title="Tama&ntilde;o en KiloBytes"><?php echo round($imagen["size"],2); ?></a>
		<a title="Dimensiones en pixeles"><?php echo $imagen["width"]."x".$imagen["height"] ?></a>
		<?php 
			if(isset($_SESSION["user_rango"]) && ($_SESSION["user_rango"] == 'Moderador' || $_SESSION["user_rango"] == 'Admin')){ ?>
			<a title="Modo"><?php echo $imagen["modo"] ?></a>
		<?php 
			}
		?>
	</div>
	
	<div class="separator" style="margin-top:10px; margin-bottom:10px;"></div>
	
	<div id="opciones-imagen">
		<i class="clear"></i>
		<?php
			if($_SESSION["user_type"] == 'registred'){
				$is_fav = $favs->verificar_favorito($_SESSION["user_id"],$imagen["id_img"]);
		?>
				<div class="btn BtnGray <?php if($is_fav == 1) echo 'BtnDsbl'; ?> left">
					<input id="AddFav" type="button" value="Añadir a favoritos" onclick="<?php if($is_fav == 0) echo 'imagen.fav('.$imagen['id_img'].')'; ?>" />
				</div>
		<?php
			}else{
				?>
				<div class="btn BtnGray left">
					<input type="button" value="Añadir a favoritos" onclick="imagen.fav('null');" />
				</div>
				<?php
			}
		?>
		<div class="btn BtnGray left">
			<input type="button" value="ver en tamaño original" />
		</div>
		<?php
			if(isset($_SESSION['user_rango']) && ($_SESSION["user_rango"] == 'Admin' || $_SESSION["user_rango"] == 'Moderador')){
				if($imagen["status"] == 'eliminada'){
					?>
						<div class="btn BtnGray left">
							<input type="button" value="Restaurar imagen" onclick="imagen.eliminar('<?php echo $IdCode; ?>',1);" />
						</div>
					<?php
				}else{
					?>
						<div class="btn BtnGray left">
							<input type="button" value="Eliminar imagen" onclick="imagen.eliminar('<?php echo $IdCode; ?>',0);" />
						</div>
					<?php
				}
			}
		?>
	</div>
</div>
<script type="text/javascript" language="javascript">
	$('.link-input').click(function(){
		$(this).select();
	});
</script>
