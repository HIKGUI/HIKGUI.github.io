<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

//CONEXÃO COM O BANCO
include_once("../PHP/conexao.php");
    
    //CASO PRESSIONADO O BOTÃO DE ATUALIZAR
    if($_GET['hr_cod']){
    
    //ADD O CPF A VARIAVEL
    $hr_cod = $_GET['hr_cod'];

   //FAZ ATUALIZAÇOES NOS DADOS DA TABELA
        $sql = "UPDATE tb_horarios
        SET hr_disponivel = 'v'
        WHERE hr_cod = $hr_cod";

        $conn->exec($sql);
    
    
}
        header("location: thorarios_adm.php");
        
        

    
?>