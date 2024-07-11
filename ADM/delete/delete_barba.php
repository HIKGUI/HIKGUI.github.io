<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

// CONEXÃO COM O BANCO
include_once "../../PHP/conexao.php";

if($_GET['tp_barba_cod']){
    
    //ADD O CPF A VARIAVEL
    $tp_barba_cod = $_GET['tp_barba_cod'];

    //DELETA DA TB DE LOGIN, ONDE O CPF FOR IGUAL AO ADICIONADO DA VARIAVEL
    $sql = "DELETE FROM tb_corte_barba WHERE tp_barba_cod = $tp_barba_cod";
    $conn->exec($sql);
    
    header("location: ../tcortes_adm.php");
}


?>