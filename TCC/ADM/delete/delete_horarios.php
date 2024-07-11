<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

// CONEXÃO COM O BANCO
include_once "../../PHP/conexao.php";

if($_GET['hr_cod']){
    
    //ADD O CPF A VARIAVEL
    $hr_cod = $_GET['hr_cod'];

    //DELETA DA TB DE LOGIN, ONDE O CPF FOR IGUAL AO ADICIONADO DA VARIAVEL
    $sql = "DELETE FROM tb_horarios WHERE hr_cod = $hr_cod";
    $conn->exec($sql);
    
    header("location: ../thorarios_adm.php");
}


?>