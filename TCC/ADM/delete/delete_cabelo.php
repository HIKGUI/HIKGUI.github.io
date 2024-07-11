<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

// CONEXÃO COM O BANCO
include_once "../../PHP/conexao.php";

if($_GET['tp_cabelo_cod']){
    
    //ADD O CPF A VARIAVEL
    $tp_cabelo_cod = $_GET['tp_cabelo_cod'];

    //DELETA DA TB DE LOGIN, ONDE O CPF FOR IGUAL AO ADICIONADO DA VARIAVEL
    $sql = "DELETE FROM tb_corte_cabelo WHERE tp_cabelo_cod = $tp_cabelo_cod";
    $conn->exec($sql);
    
    header("location: ../tcortes_adm.php");
}


?>