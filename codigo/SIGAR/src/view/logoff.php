<?php
	//inclus�o da p�gina que valida a sess�o do usu�rio
	include "validaSession.php";
	//destroi a sess�o do usu�rio
	$ObjSessao->logoff();
?>