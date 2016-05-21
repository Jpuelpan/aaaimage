<?php
if(isset($_GET["view"]) && $_GET["view"] == 'true') $cantidad = 30; else $cantidad = 12;
$thumbs = $img->visualizar_imagenes($cantidad);
?>
<div id="last-images" class="left rounded-4">
	<div class="clear"></div>
	
	<a class="move-page back left" onclick="page.back();">Im&aacute;genes recientes</a>
	<a class="move-page forward right" onclick="page.forward();">Im&aacute;genes anteriores</a>
	<input type="hidden" id="ActualPage" value="0" />
	
	<h1 class="select-type">
		&Uacute;ltimas imagenes p&uacute;blicas 
		<span class="arrow-down right"></span> 
	</h1>
	
	<!--<div class="Wrapper-select" id="select-last">
		<div class="Wrapper-option">
			<a class="option-link-selected" onclick="select.open($(this));">Ultimas imagenes <span class="right"></span> </a>
		</div>
		<div class="Wrapper-option-list">
			<a class="option-link" onclick="select.choose($(this));" title="Ultimas imagenes"> <i></i> Ultimas imagenes</a>
			<a class="option-link" onclick="select.choose($(this));" title="Ultimas galerias"> <i></i> Ultimas galerias</a>
		</div>
		<input type="hidden" id="selection-last" value="0" />
	</div>-->
	
	<div class="Wrap-images">
	<?php for($i=0;$i<count($thumbs);$i++){ ?>		
		<?php
		
			if(isset($_SESSION["user_rango"]) && ($_SESSION["user_rango"] == 'Admin' || $_SESSION["user_rango"] == 'Moderador')){
				?>
					<div class="Wrapper-thumbnail <?php if($thumbs[$i]['status'] == 'eliminada') echo 'del-img'; ?>">
					<a href="<?php echo RAIZ ?>/imagenes/<?php echo $thumbs[$i]["id_img"] ?>" title="<?php echo $thumbs[$i]["name"] ?>">
						<span style="background:url(<?php echo RAIZ.'/'.$thumbs[$i]["thn"] ?>) no-repeat;"></span>
					</a>
					</div>
				
				<?php
			}elseif($thumbs[$i]["modo"] == 'publica' && $thumbs[$i]["status"] == 'normal'){
				?>
					<div class="Wrapper-thumbnail">
					<a href="<?php echo RAIZ ?>/imagenes/<?php echo $thumbs[$i]["id_img"] ?>" title="<?php echo $thumbs[$i]["name"] ?>">
						<span style="background:url(<?php echo RAIZ.'/'.$thumbs[$i]["thn"] ?>) no-repeat;"></span>
					</a>
					</div>
				<?php
			}
		?>
	<?php 
		} 
	?>
	</div>
	
	<div id="Select-view" class="right">
		<div class="clear"></div>
		<span class="left" style="padding-top:6px;">Mostrar&nbsp;</span>
		<div class="right">
			<div class="WrapSelect">
				<a class="BtnSelect BtnSelectOnHover">
					<span>ultimas imagenes</span> 
					<i></i> 
				</a>
			<div class="SelectMenuWrap">
				<ul class="MenuSelect">
					<li>
						<a> <i></i> <span>ultimas imagenes</span></a>
					</li>
					<li>
						<a> <i></i> <span>ultimas galerias</span></a>
					</li>
				</ul>
			</div>
				<input type="hidden" value="0" />
			</div>
		</div>
	</div>
	
	<script type="text/javascript" language="javascript">
		
		$(document).ready(function(){			
			$('.MenuSelect li a').hover(function(){
				$(this).children('i').toggleClass('SelectIconActive');
			});
			
			$('.BtnSelect').click(function(){
				select.open($(this));
			});
		});
		
		
	</script>
	
	
	
	
	
	
	
	
	
</div>
<div class="clear"></div>
