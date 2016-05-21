<?php
class Imagen extends Aaaimage{

	public function visualizar_imagenes($cant,$page = 0){
		if($_SESSION["user_type"] == 'temporal' || $_SESSION["user_type"] == 'registred') $donde = "WHERE status='normal' AND modo='publica'";
		if(isset($_SESSION["user_rango"]) && $_SESSION["user_rango"] != 'Normal') $donde = "";
		$sql = "SELECT id_img,name,thn,status,modo FROM imagenes $donde ORDER BY id_img DESC LIMIT $page,$cant";
		$res = mysql_query($sql, $this->con() );
		$imagen = null;
		while($reg = mysql_fetch_assoc($res)){
			$imagen[] = $reg;
		}
		mysql_close();
		return $imagen;
	}
	
	public function visualizar_imagen(){
		$id = (int)$_GET["img"];
		$sql = "SELECT ".
			   "imagenes.id_img, ".
			   "imagenes.name, ".
			   "imagenes.img, ".
			   "imagenes.thn, ".
			   "imagenes.res, ".
			   "imagenes.modo, ".
			   "imagenes.status, ".
			   "imagenes.user_id, ".
			   "datosimagen.id_imagen, ".
			   "datosimagen.tipo, ".
			   "datosimagen.size, ".
			   "datosimagen.width, ".
			   "datosimagen.height, ".
			   "datosimagen.height_res ".
			   " FROM ".
			   "imagenes,datosimagen ".
			   "WHERE ".
			   "imagenes.id_img=$id ".
			   "AND ".
			   "datosimagen.id_imagen=$id ";
		
		// return $sql;
		
		$res = mysql_query($sql,$this->con());
		if($reg = mysql_fetch_assoc($res)){
			$imagen = $reg;
			$imagen['error'] = false;
			return $imagen;
		}else{
			$imagen['error'] = true;
			$imagen['text'] = 'imagen no encontrada';
			return $imagen;
		}
	}
	
	public function rand_images(){
		$sql = "SELECT id_img,name,thn,status,modo FROM imagenes WHERE status='normal' AND modo='publica' ORDER BY RAND() LIMIT 0,6";
		$res = mysql_query($sql,$this->con());
		$imagenes = null;
		while($reg = mysql_fetch_assoc($res)){
			$imagenes[] = $reg;
		}
		return $imagenes;
	}
	
	public function guardar_imagen($img,$resi,$thumb){
		if($img["error"] == 1) return 0;
		$sql = "INSERT INTO ".
			   "imagenes ".
			   "(id_img,name,img,res,thn,user_id,modo,status,fecha) ".
			   "VALUES ".
			   "(NULL,'".$img["nombre"]."','".$img["destino"]."','".$resi["destino"]."','".$thumb["destino"]."','".$_SESSION["user_id"]."','".$_POST["status"]."','normal',".time().") ";
		$res = mysql_query($sql,$this->con());
		$last_imagen = mysql_insert_id();
		$sql2 = "INSERT INTO ".
			   "datosimagen ".
			   "(id_dato,id_imagen,tipo,size,width,height,height_res,pais) ".
			   "VALUES ".
			   "(NULL,".$last_imagen.",'".$img["tipo"]."','".$img["size"]."',".$img["ancho"].",".$img["alto"].",".$resi["alto"].",'".$this->get_pais($_SERVER['REMOTE_ADDR'])."')";
		$res2 = mysql_query($sql2,$this->con());
		return $res2;
	}
	
	public function eliminar_imagen($id){
		$id = htmlspecialchars($id);
		$sql = "UPDATE imagenes SET status='eliminada' WHERE SHA1(id_img)='$id'";
		$res = mysql_query($sql,$this->con());
		return mysql_affected_rows();
	}
	
	public function restaurar_imagen($id){
		$id = htmlspecialchars($id);
		$sql = "UPDATE imagenes SET status='normal' WHERE SHA1(id_img)='$id'";
		$res = mysql_query($sql,$this->con());
		return mysql_affected_rows();
	}
	
	
	
	
	
	
	
	
}
?>
