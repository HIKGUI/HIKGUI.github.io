<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

// CONEXÃO COM O BANCO
include_once "../PHP/conexao.php";


//PEGA O CPF DA URL PARA DELETAR O CLIENTE E AS INFO. DO MESMO NO BANCO
if($_GET['cpf']){
    
    //ADD O CPF A VARIAVEL
    $cpf = $_GET['cpf'];

    //DELETA DA TB DE CLIENTES, ONDE O CPF FOR IGUAL AO ADICIONADO DA VARIAVEL
    $sql = "DELETE FROM tb_usuarios WHERE us_cpf = $cpf";
    $conn->exec($sql);
    
    //DELETA DA TB DE AGENDAMENTO, ONDE O CPF FOR IGUAL AO ADICIONADO DA VARIAVEL
    $sql = "DELETE FROM tb_agendamentos WHERE log_cod_ag = $cpf";
    $conn->exec($sql);
    
    header("location: tagendamento_adm.php");
    
}elseif($_GET['cod']){
    
    //ADD O CPF A VARIAVEL
    $hr_cod = $_GET['cod'];

    //DELETA DA TB DE LOGIN, ONDE O CPF FOR IGUAL AO ADICIONADO DA VARIAVEL
    $sql = "DELETE FROM tb_horarios WHERE hr_cod = $hr_cod";
    $conn->exec($sql);
    
    header("location: thorarios_adm.php");
}


?>