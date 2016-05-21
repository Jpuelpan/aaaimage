<?php

require_once("inc/classes/class.php");
session_destroy();
setcookie("spr","dato",time() - 60*60*24*30,"/");
header("location:index.php");



?>
