<?php
if(!file_exists("config.php")) header("location:install");
$this_page = $_GET["section"];
require_once("config.php");
require_once("inc/usuario.php");
