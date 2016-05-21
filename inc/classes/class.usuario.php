<?php

class Usuario extends Aaaimage{
	
	public function usuario_temporal($user_tmp){
		if($user_tmp === 'normal') $id_usuario = SHA1($_SERVER["REMOTE_ADDR"].time()); else $id_usuario = $user_tmp;
		$_SESSION["user_id"] = $id_usuario;
		$_SESSION["user_type"] = "temporal";
		$_SESSION["user_ip"] = $_SERVER["REMOTE_ADDR"];
		setcookie("spr","".$id_usuario."",time() + 60*60*24*30,"/");
		// header("location:http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	}
	
	public function check_user(){
		if(!isset($_COOKIE["spr"])){
			$this->usuario_temporal('normal');
		}elseif(isset($_COOKIE["spr"]) && !isset($_SESSION["user_id"])){
			$this->usuario_temporal($_COOKIE["spr"]);
		}
	}
	
	public function verificar_user($user){
		$sql = sprintf("SELECT usuario FROM usuarios WHERE usuario='%s';",mysql_real_escape_string(htmlspecialchars($user),$this->con()));
		$res = mysql_query($sql,$this->con());
		return mysql_num_rows($res);
	}
	
	public function verificar_correo($correo){
		$sql = sprintf("SELECT correo FROM usuarios WHERE correo='%s';",mysql_real_escape_string(htmlspecialchars($correo),$this->con()));
		$res = mysql_query($sql,$this->con());
		return mysql_num_rows($res);
	}
	
	public function registrar_usuario(){
		$name = htmlspecialchars($_POST["nombre"]);
		$user = htmlspecialchars($_POST["usr"]);
		$correo = $_POST["correo"];
		$pass = $_POST["pass"];
		
		$sql = "INSERT INTO ".
			   "usuarios ".
			   "(id_user,nombre,usuario,pass,correo,status,rango,registro,pais,ip) ".
			   "VALUES ".
			   "(NULL,'$name','$user','".SHA1($pass)."','$correo','Inactivo','Normal',".time().",'".$this->get_pais($_SERVER['REMOTE_ADDR'])."','".$_SERVER["REMOTE_ADDR"]."');";
		$res = mysql_query($sql,$this->con());
		return mysql_insert_id();
	}

	public function activar_usuario(){
		$id = htmlspecialchars($_GET["id"]);
		$ip = htmlspecialchars($_GET["ip"]);
		$sql = sprintf("SELECT ".
		      "id_user,ip,status ".
		       "FROM ".
		       "usuarios ".
		       "WHERE ".
		       "MD5(usuarios.id_user)='%s' ".
		       "AND ".
		       "SHA1(usuarios.ip)='%s';".
		       "",mysql_real_escape_string($id,$this->con()),mysql_real_escape_string($ip,$this->con()));
		$res = mysql_query($sql,$this->con());
		
		if(mysql_num_rows($res) != 0){
			if($reg = mysql_fetch_assoc($res)){
				$user = $reg;
			}

			if($user["status"] == "Inactivo"){
				$sql = "UPDATE usuarios SET status='Activo' WHERE MD5(id_user)='".$id."' AND SHA1(ip)='".$ip."';";
				$res = mysql_query($sql,$this->con());				
				return mysql_affected_rows(); //devuelve 1 ya quw es el numero de registros afectados
			}else{
				return $user["status"]; //retorna el estado de la cuenta
			}
		}
		return 0; // cero indica que no hay coincidencias con el id usuario o con la ip actual
	}

	public function renovar_ip($id_usr){
		$ip = $_SERVER["REMOTE_ADDR"];
		$sql = "UPDATE usuarios SET ip='$ip' WHERE id_user='$id_usr';";
		$res = mysql_query($sql,$this->con());
		return mysql_affected_rows();
	}

	public function crear_cookies($datos){
		$_SESSION["user_id"] = $datos["id_user"];
		$_SESSION["user_nombre"] = $datos["nombre"];
		$_SESSION["user_usuario"] = $datos["usuario"];
		$_SESSION["user_correo"] = $datos["correo"];
		$_SESSION["user_status"] = $datos["status"];
		$_SESSION["user_rango"] = $datos["rango"];
		$_SESSION["user_registro"] = $datos["registro"];
		$_SESSION["user_pais"] = $datos["pais"];
		$_SESSION["user_ip"] = $_SERVER["REMOTE_ADDR"];
		$_SESSION["user_type"] = "registred";
		
		setcookie("spr","".SHA1($datos["id_user"])."",time() + 60*60*24*30,"/");
		
		return "ok";
	}

	public function iniciar_sesion($user,$password){
		$user = htmlspecialchars($user);
		$password = SHA1(htmlspecialchars($password));
		$sql = sprintf("SELECT ".
		       "id_user,nombre,usuario,correo,status,rango,correo,registro,pais,ip ".
		       "FROM usuarios ".
		       "WHERE ".
		       "usuario='$user' ".
		       "AND ".
		       "pass='$password';".
		       "",mysql_real_escape_string($user,$this->con()),mysql_real_escape_string($password,$this->con()));
		$res = mysql_query($sql,$this->con());
		
		if(mysql_num_rows($res) != 0){
			
			if($reg = mysql_fetch_assoc($res)){
				$user = $reg;
			}
			if($user["status"] == 'Inactivo'){ return "in"; }
			elseif($user["status"] == 'Eliminado'){ return "del";}
			else{
				if($_SERVER["REMOTE_ADDR"] != $user["ip"]){ $this->renovar_ip($user["id_user"]); } 
				return $this->crear_cookies($user);
			} 


		}else{
			return $sql; //retorna cero si no hay coincidencia
		}	
	}















}
?>
