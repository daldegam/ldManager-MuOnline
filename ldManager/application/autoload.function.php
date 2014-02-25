<?php
/*
	@Function for autoload classes
*/
function __autoload($module)
{
    $module = urlencode($module);
	try {
		if(file_exists("application/class/".strtolower($module).".class.php") === true)
			require_once("application/class/".strtolower($module).".class.php");
		else
			throw new Exception("Erro ao carregar m&oacute;dulo: ".$module);		
	} catch (Exception $e) {
		exit($e->getMessage());
	}
}
?>