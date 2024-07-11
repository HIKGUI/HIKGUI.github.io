<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

if($_GET['cpf']){
        
        //CONEXÃO COM BANCO
      include_once('../PHP/conexao.php');
      
        //ADD CPF A VARIAVEL
        $cpf = $_GET['cpf'];
        
        //FAZ ATUALIZAÇOES NOS DADOS DA TABELA
        $sql = "UPDATE tb_usuarios
        SET us_tipo = 'func'
        WHERE us_cpf=$cpf";

        $conn->exec($sql);
        

      }
      
      //VOLTA PARA A TABELA DE CLIENTES
      header('Location: tfuncionarios_adm.php');

?>