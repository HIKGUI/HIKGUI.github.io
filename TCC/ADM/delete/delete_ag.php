<?php 
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

//CONEXÃO COM O BANCO 
include_once "../../PHP/conexao.php";

//PEGA O CODIGO DO AGENDAMENTO 
$ag_cod = $_GET['ag_cod'];

//SE O CODIGO FOR IGUAL AO SELCIONADO
if($ag_cod = $_GET['ag_cod']){
    
    //DELETAR O CODIGO DA TABELA
    $sql = "DELETE FROM tb_agendamentos WHERE ag_cod = $ag_cod";
    $conn->exec($sql);
    
    
}
//VOLTA PARA A PG DAS TABELAS DE AGENDAMENTO
    header('Location: ../tagendamento_adm.php');
?>