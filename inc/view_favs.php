<?php

$MyFavorites = $favs->visualizar_favoritos();

//print_r($MyFavorites);

if($_SESSION["user_type"] == 'temporal') header("location:".RAIZ.'/login');

?>
<div id="list-favs">
	<?php
		if($MyFavorites == false) die("No teni niun favorito guardao po ¬¬");
		for($i=0;$i<count($MyFavorites);$i++){ 
	?>		
		<div id="fav_<?php echo $MyFavorites[$i]['id_fav'] ?>" class="Wrapper-thumbnail <?php if($MyFavorites[$i]['status'] == 'eliminada') echo 'del-img'; ?>">
			<i class="icon_24 Delete-Fav" title="Eliminar esta imagen de mis favoritos" onclick="imagen.del_fav('<?php echo $MyFavorites[$i]['id_fav']; ?>')"></i>
			<a href="<?php echo RAIZ ?>/imagenes/<?php echo $MyFavorites[$i]["id_img"] ?>" title="<?php echo $MyFavorites[$i]["name"] ?>">
				<span style="background:url(<?php echo RAIZ.'/'.$MyFavorites[$i]["thn"] ?>) no-repeat;"></span>
			</a>
		</div>
	<?php 
		} 
	?>
</div>

<script type="text/javascript" language="javascript">
	$('.Wrapper-thumbnail').hover(function(){
		$(this).children('i').toggle();
	},function(){
		$(this).children('i').toggle();
	});
</script>
