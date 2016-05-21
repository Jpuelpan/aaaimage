<?php

class Favoritos extends Aaaimage{
	public function agregar_favorito($img){
		if($_SESSION["user_type"] == 'temporal') return 'ses';
		if($this->verificar_favorito($_SESSION["user_id"],$img) == 1) return 'exts';
		$sql = "INSERT INTO ".
		       "favs ".
		       "(id_fav,img,user_id,fecha) ".
		       "VALUES ".
		       "(NULL,'".$img."','".$_SESSION["user_id"]."','".time()."');";
		$res = mysql_query($sql,$this->con());
		return mysql_insert_id();
	}
	
	public function eliminar_favorito($id){
		if($_SESSION["user_type"] == 'temporal') return 'ses';
		if($this->verificar_favorito($_SESSION["user_id"],$id,$id) == 0) return 'error';
		$sql = "DELETE FROM favs WHERE id_fav=$id";
		$res = mysql_query($sql,$this->con());
		return mysql_affected_rows();
	}
	
	public function verificar_favorito($usr,$img,$id = null){
		if($id != null) $donde = 'favs.id_fav'; else $donde = 'favs.img';
		$sql = "SELECT ".
		       "favs.img,".
		       "favs.id_fav, ".
		       "favs.user_id ".
		       "FROM ".
		       "favs ".
		       "WHERE ".
		       "favs.user_id=$usr ".
		       "AND ".
		       "$donde=$img ;";
		$res = mysql_query($sql,$this->con());
		return mysql_num_rows($res);
	}
	
	public function visualizar_favoritos(){
		$sql = "SELECT ".
		       "favs.id_fav, ".
		       "favs.img, ".
		       "favs.user_id, ".
		       "favs.fecha, ".
		       "imagenes.id_img, ".
		       "imagenes.name, ".
		       "imagenes.thn, ".
		       "imagenes.modo, ".
		       "imagenes.status ".
		       "FROM favs,imagenes ".
		       "WHERE favs.user_id='".$_SESSION["user_id"]."' ".
		       "AND ".
		       "favs.img=imagenes.id_img ".
		       "AND ".
		       "imagenes.status='normal'".
		       "ORDER by favs.id_fav DESC ".
		       "LIMIT 0,20";
		$res = mysql_query($sql,$this->con());
		if(mysql_num_rows($res) == 0) return false;
		while($reg = mysql_fetch_assoc($res)){
			$image_fav[] = $reg;
		}
		return $image_fav;
	}
}


















?>
