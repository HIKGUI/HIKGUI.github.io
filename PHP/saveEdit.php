<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

//CONEXÃO COM O BANCO
include_once("conexao.php");
    
    //CASO PRESSIONADO O BOTÃO DE ATUALIZAR
    if(isset($_POST['update']))
    {
        //RECEBE NOVO CPF
        $up_cpf = $_POST['up_cpf'];
        
        //RECEBE NOVO NOME
        $up_nome = $_POST['up_nome'];
        
        //RECEBE NOVO TELEFONE
        $up_tell = $_POST['up_tell'];
        
        //RECEBE NOVA DATA DE NASCIMENTO
        $up_dt_nasc = $_POST['up_dt_nasc'];
        
        //RECEBE NOVO SEXO
        $up_sexo = $_POST['up_sexo'];
        
        //RECEBE NOVA SENHA
        $up_senha = $_POST['up_senha'];
        $up_senha = md5($up_senha);
        
        //FAZ ATUALIZAÇOES NOS DADOS DA TABELA
        $sql = "UPDATE tb_usuarios
        SET us_nome = '$up_nome', us_tell = $up_tell, us_dat_nasc = '$up_dt_nasc', us_sexo = '$up_sexo', us_senha =  '$up_senha'
        WHERE us_cpf=$up_cpf";

        $conn->exec($sql);
        

      }
      
      //VOLTA PARA A TABELA DE CLIENTES
      header('Location: ../tclientes.php');

?>