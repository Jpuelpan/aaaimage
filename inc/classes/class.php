<?php
session_start();

class Aaaimage{
	
	public function con(){
		$c = @mysql_connect( MYSQL_HOST , MYSQL_USER , MYSQL_PASS) or die ('Ha ocurrido un error en la conexi&oacute;n MYSQL');
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db(MYSQL_DB);
		return $c;
	}
	
	public function error($text){
		echo '<div id="error-box">
				<p class="wops-msg left">Wops!</p>
				<p class="dntexst-msg left">'.$text.'</p>
				</div>';
	}
	
	public function get_pais($ip_address){
		if($ip_address == '127.0.0.1') return 'local';
		//By Marc Palau (http://www.nbsp.es)
		$url = "http://ip-to-country.webhosting.info/node/view/36";
		$inici = "src=/flag/?type=2&cc2=";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST,"POST");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "ip_address=$ip_address"); 
		
		ob_start();
		
		curl_exec($ch);
		curl_close($ch);
		$cache = ob_get_contents();
		ob_end_clean();
		
		$resto = strstr($cache,$inici);
		$pais = substr($resto,strlen($inici),2);
		
		return $pais;
   }
	
}
?>
