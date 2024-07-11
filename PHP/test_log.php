<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

//CONEXÃO COM O BANCO
include_once('conexao.php');

//INICIA UMA SESSÃO
session_start();

//RECEBE A VAIDAÇÃO
$valido = $_SESSION['log_valido'];

    //VERIFICA SE A SESSÃO ESTA VAZIA
if(empty($_SESSION['log_cpf'])){
    
    //ENVIA APARA APAGINA DE LOGIN
    header("location: ../login.php");    
    
    
}   // VARIAVEL RECEBE O LOGIN DA SESSÃO
    $cpf = $_SESSION['log_cpf'];

    //VERIFICA SE A SESSÃO ESTA VAZIA
if(empty($_SESSION['log_senha'])){
    //ENVIA APARA APAGINA DE LOGIN
    header("location: ../login.php");    
    
    
}   // VARIAVEL RECEBE O LOGIN DA SESSÃO
    $codsenha = $_SESSION['log_senha'];

        
        
        //CASO VARIAVEL VALIDA FOR VERDADEIRA
        if($valido = true){
            
                //PEGA TODOS OS DADOS DA TABELA DE LOGINS ONDE O CPF INFORMADO É O MESMO QUE ESTA NA TABELA
                $sql = $conn->prepare("SELECT us_tipo FROM tb_usuarios WHERE us_cpf = $cpf");            
                $sql->execute();
                
                //ASSOCIA OS DADOS DO BANCO A VARIAVEL
                while ($test = $sql->fetch(PDO::FETCH_ASSOC)) {
                
                    //RECEBE LOG_ADM
                    $adm_log = $test['us_tipo'];
                    
                    //CASO ADM_LOG FOR SIM
                    if ( $adm_log === 'adm') {
                        
                        //IR PARA A TABELA DE CLIENTES
                        header("location: ../ADM/tagendamento_adm.php");
                        
                        //CASO NÃO
                    }elseif ($adm_log === 'func'){
                        header("location: ../FUNC/func-agendamento.php");
                        
                        
                    }else{
                        //IR PARA A TELA INICIAL
                        header("location: ../agendamento.php");
                    }
        
                }
            }
        

    ?>