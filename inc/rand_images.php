<?php
	$imagenes_randoms = $img->rand_images();	
?>
<div id="rand_images">
	<?php for($i=0;$i<count($imagenes_randoms);$i++){ ?>
		<div class="Wrapper-thumbnail">
			<a href="<?php echo RAIZ ?>/imagenes/<?php echo $imagenes_randoms[$i]["id_img"] ?>" title="<?php echo $imagenes_randoms[$i]["name"] ?>">
				<span style="background:url(<?php echo RAIZ.'/'.$imagenes_randoms[$i]["thn"] ?>) no-repeat;"></span>
			</a>
		</div>
	<?php } ?>
</div>