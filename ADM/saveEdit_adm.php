<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

//CONEXÃO COM O BANCO
include_once("../PHP/conexao.php");
    
    //CASO PRESSIONADO O BOTÃO DE ATUALIZAR
    if(isset($_POST['update']))
    {
        //RECEBE NOVO CPF
        $up_cpf = $_POST['up_cpf'];
        
        //RECEBE NOVA SITUAÇÃO
        $up_situacao = $_POST['up_situacao'];
        
        //RECEBE NOVA SENHA
        $up_senha = $_POST['up_senha'];
        $up_senha = md5($up_senha);
        
        //FAZ ATUALIZAÇOES NOS DADOS DA TABELA
        $sql = "UPDATE tb_usuarios
        SET us_situacao = '$up_situacao', us_senha =  '$up_senha'
        WHERE us_cpf=$up_cpf";

        $conn->exec($sql);
        

      }
      
      //VOLTA PARA A TABELA DE CLIENTES
      header('Location: tclientes_adm.php');

?>