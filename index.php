<?php
if(!file_exists("config.php")) header("location:install");
$this_page = "index";
require_once("config.php");
require_once("inc/home.php");
