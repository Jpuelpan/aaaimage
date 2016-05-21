
class Resize extends Aaaimage{
	private $tipos = array('jpg','jpeg','png');
	private $image = array();
	private $max_size = 2048;
	private $max_files = 1004;
	
	public function filtrar_imagen($nombre){
		$name = explode(".",$nombre);
		$ext = end($name);
		if(in_array(strtolower($ext),$this->tipos)){
			unset($name[count($name)-1]);
			$this->image["nombre"] = htmlspecialchars(implode($name),ENT_QUOTES);
			$this->image["tipo"] = strtolower($ext);
			$this->image["error"] = 0;
			return true;
		}else{
			$this->image["error"] = 1;
			$this->image["error_name"] = "Archivo no soportado";
			return false;
		}
	}
	
	public function tamano_imagen($size){
		$size = $size / 1024;
		if($size <= $this->max_size){
			$this->image["size"] = $size;
			$this->image["error"] = 0;
			return true;
		}else{
			$this->image["error"] = 1;
			$this->image["error_name"] = "El archivo supera los ".$this->max_size." ";
			return false;
		}
	}
	
	public function posicion_imagen($src){
		list($ancho,$alto) = getimagesize($src);
		$this->image["ancho"] = $ancho;
		$this->image["alto"] = $alto;
		if($ancho < $alto) return "V"; else return "H";
	}
	
	public function nombre_imagen(){
		$this->image["file_name"] = strtoupper(hash("crc32b",$_SERVER["REMOTE_ADDR"].date("His")));
		return $this->image["file_name"];
	}
	
	public function verificar_directorio($route){
		if($path = opendir($route)){
			$folders = scandir($route);
			if($folders != false){
				$last_folder = end($folders);
				if($path = opendir($route.'/'.$last_folder)){
					unset($folders);
					$folders = scandir($route.'/'.$last_folder);
					if($folders != false){
						if(count($folders) <= $this->max_files){
							return $route.'/'.$last_folder;
						}else{
							$new_folder = $last_folder + 1;
							if(mkdir($route.'/'.$new_folder)) return $route.'/'.$new_folder; else return false;
						}
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function origen_reduccion(){
		$format = $this->image["tipo"];
		if($format == 'jpeg' || $format == 'jpg') return imagecreatefromjpeg($this->image["destino"]);
		if($format == 'png') return imagecreatefrompng($this->image["destino"]);
		if($format == 'gif') return imagecreatefromgif($this->image["destino"]);
	}
	
	public function destino_reduccion($thumb,$path,$calidad){
		$format = $this->image["tipo"];
		$destiny = $this->verificar_directorio($path).'/'.$this->image["file_name"].'.'.$format;
		if($format == 'jpg' || $format == 'jpeg'){
			imageJPEG($thumb,$destiny,$calidad);
			return $destiny;
		}elseif($format == 'png'){
			imagePNG($thumb,$destiny);
			return $destiny;
		}
	}
	
	public function subir_imagen($data,$path,$mode){
		if($this->filtrar_imagen($data["name"]) == true){
			if($this->tamano_imagen($data["size"]) == true){
				if($mode == false) $destino = $path; else $destino = $this->verificar_directorio($path);
				if($destino){
					$nombre = $this->nombre_imagen().".".$this->image["tipo"];
					if(move_uploaded_file($data["tmp_name"], $destino.'/'.$nombre) == true){
						$this->image["destino"] = $destino.'/'.$nombre;
						$this->posicion_imagen($this->image["destino"]);
						return $this->image;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return $this->image;
			}
		}else{
			return $this->image;
		}
	}
	
	public function reducir_imagen($measure,$path,$calidad){
		if($this->image["error"] == 1) return $this->image;
		$pos = $this->posicion_imagen($this->image["destino"]);
		if($pos == 'H' && $measure >= $this->image["ancho"]){
			copy($this->image["destino"],$this->verificar_directorio($path).'/'.$this->image["file_name"].'.'.$this->image["tipo"]);
			$dest =  $this->verificar_directorio($path).'/'.$this->image["file_name"].'.'.$this->image["tipo"];
		}elseif($pos == 'V' && $measure >= $this->image["alto"]){
			copy($this->image["destino"],$this->verificar_directorio($path).'/'.$this->image["file_name"].'.'.$this->image["tipo"]);
			$dest =  $this->verificar_directorio($path).'/'.$this->image["file_name"].'.'.$this->image["tipo"];
		}else{
			if($pos == 'H') $relation = $measure / $this->image["ancho"] * $this->image["alto"];
			if($pos == 'V') $relation = $measure / $this->image["alto"] * $this->image["ancho"];		
			if($pos == 'H') $thumb = ImageCreateTrueColor($measure,$relation);
			if($pos == 'V') $thumb = ImageCreateTrueColor($relation,$measure);
			if($pos == 'H') imagecopyresampled($thumb,$this->origen_reduccion(),0,0,0,0,$measure,$relation,$this->image["ancho"],$this->image["alto"]);
			if($pos == 'V') imagecopyresampled($thumb,$this->origen_reduccion(),0,0,0,0,$relation,$measure,$this->image["ancho"],$this->image["alto"]);
			$dest = $this->destino_reduccion($thumb,$path,$calidad);
			imagedestroy($thumb);
		}
		
		list($an,$al) = getimagesize($dest);
		$thumbnail["destino"] = $dest;
		$thumbnail["ancho"] = $an;
		$thumbnail["alto"] = $al;
		
		return $thumbnail;
	}
}
?>