<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

// INICIA UMA SESSÃO
session_start();
 
// REMOVE AS VARIAVEIS DE SESSÃO
$_SESSION = array();
 
// DESTROI A SESSÃO
session_destroy();
 
// VOLTA A PAGINA DE LOGIN
header("location: ../login.php");

// ENCERRA O PROCESSO
exit;
?>