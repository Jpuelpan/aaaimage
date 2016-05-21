<?php
if(isset($_FILES["ImageFile"])){
// print_r($_POST);
// echo "<br /> <br />";
// print_r($_FILES);

require_once("classes/class.php");
require_once("classes/class.imagen.php");
require_once("classes/class.res.php");

$img = new Imagen;
$res = new Resize;

if(empty($_FILES["ImageFile"]["name"])){
	echo "<br /><br />Sube una imagen por favor";
	return false;
}


if($_FILES["ImageFile"]["error"] == 0){
	$upload_image = $res->subir_imagen($_FILES["ImageFile"],'up/i',true);
	$resized_image = $res->reducir_imagen(650,'up/r',95);
	$thumbnail_image = $res->reducir_imagen(180,'up/t',95);
	
	$saved_img = $img->guardar_imagen($upload_image,$resized_image,$thumbnail_image);
	
	if($saved_img == '1') header("location:".RAIZ);
	
	//echo "<br /><br />";
	//print_r($upload_image);
	//echo "<br /><br />";
	//print_r($resized_image);
	//echo "<br /> <br />";
	//print_r($thumbnail_image);
	//echo "<br /><br />";
	//print_r($saved_img);
}else{
	echo "<br /><br />La imagen supera los 2MB";
}


}else{
?>
<div id="upload-box" class="rounded-4 left <?php if($_SESSION['user_type'] == 'registred') echo 'upload-registred'; ?>">
	<h1>Sube tus imagenes... ahora!</h1>
	<div id="upload">
		<a class="change-upload right icon_16 alpha-6" style="visibility:hidden;" title="Subir desde URL"></a>
		<a class="state-image right icon_16 alpha-8 tooltip" title="Subir como privada" tooltip="Las imagenes privadas no se mostrar\xe1n en la galería publica."></a>
		<!-- Upload PC -->
		<div class="upload-pc activo" style="display:block;">
		<form action="upload" method="POST" enctype="multipart/form-data">
			<input type="file" name="ImageFile" id="ImageFile" />
			<div class="btn BtnGray shadow-one right" style="position:relative; right:65px;">
				<input type="submit" value="Subir" />
			</div>
			<input type="hidden" class="state-input" name="status" value="Publica" />
		</form>
		</div>
		<!-- Fin Upload PC -->
		
		<!-- Upload link -->
		<div class="upload-link" style="display:none;">
			<form action="javascript:void(0);">
				<div class="Wrapper-inputs left" style="left:110px; height:;">
					<div class="clear"></div>
					<div class="Wrapper-text left" style="border-right:none;">
						<input type="text" placeholder="Pega la URL aqu&iacute;" />
					</div>
					<div class="btn BtnGray shadow-one right">
						<input type="submit" value="Subir" />
					</div>
				</div>
				<input type="hidden" class="state-input" name="status" value="Publica" />
			</form>
			<div class="clear"></div>
		</div>
		<!-- Fin Upload link -->
	</div>
	<p id="caract">Formatos soportados : jpeg | jpg | png | gif <br /> Tama&ntilde;o m&aacute;ximo : 2MB </p>
</div>
<?php
}
?>
