<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

//CONECTA COM O BANCO
include_once('PHP/conexao.php');

 
//INICIA UMA SESSAO
session_start();

//VARIAVEIS DE VERIFICAÇÃO
$cpf = $cpfErr = "";
$cpfConf = $codsenhaConf = $valido = false;
$codsenha = $codsenhaErr = "";

//CASO CLICADO NO BOTÃO FAZER AS VERIFICAÇÕES
if(isset($_POST['submit'])){
    
    //CASO CPF VAZIO MOSTRAR ERRO
    if(empty($_POST['cpf'])){
        $cpfErr = "Digite o CPF";
        
    //CASO NÃO, ADD DADOS A VARIAVEL E CONFIRMA
    }else{
        $cpf = $_POST['cpf'];
        $cpfConf = true;

    //CASO CODSENHA VAZIO MOSTRAR ERRO
    }if(empty($_POST['codsenha'])) {
        $codsenhaErr = "Digite a senha";

    //CASO NÃO, ADD DADOS A VARIAVEL E CONFIRMA
    }else{            
        $codsenha = $_POST['codsenha'];
        $codsenha = md5($codsenha);
        $codsenhaConf = true;
    }
    
    //REMOVE CARACTERES ESPECIAIS DO CPF
    function limp_cpf($cpf){
    
    //PEGA A VARIAVEL DO CPF E DEIXA APENAS OS NUMEROS SEM ESPAÇOS
    $res1 = preg_replace('/[^0-9]/', '', $cpf);
    return $res1;
    }
    
    //DEVOLVE VALOR A VARIAVEL
    $cpf = limp_cpf($cpf);
    
    //PEGA DADOS DO BANCO ONDE CLI_CPF = CPF INFORMADO
    $sql = $conn->prepare("SELECT us_situacao FROM tb_usuarios WHERE us_cpf = $cpf");            
    $sql->execute();
        
        //CRIA UM 'ARRAY' RECOLHENDO OS DADO, INFORMANDO SITUAÇÃO DOS CLIENTES
        while ($test = $sql->fetch(PDO::FETCH_ASSOC)) {
            
            //ADD A VARIAVEL A INFORMAÇÃO QUE ESTA NO CLI_SITUAÇÃO
            $cli_valido = $test['us_situacao'];
        
            //CASO FOR DIFERENTE DE BLOQUEADO
            if($cli_valido != 'blk'){
            
    //PEGA OS DADOS DO BANCO CLI_CPF E CLI_SENHA ONDE CLI_CPF = CPF INFORMADO
    $sql = $conn->prepare("SELECT us_cpf, us_senha FROM tb_usuarios WHERE us_cpf = $cpf");            
    $sql->execute();
        
        //CRIA UM 'ARRAY' RECOLHENDO OS DADOS DOS CLIENTES E ASSOCIANDO A  VARIAVEL
        while ($test = $sql->fetch(PDO::FETCH_ASSOC)) {
            
            //RECEBE CLI_SENHA
            $conf_senha = $test['us_senha'];
            
            //RECEBE CLI_CPF
            $conf_cpf = $test['us_cpf'];

            //CASO SENHA INFORMADA SEJA DIFERENTE DA CADASTRADA
            if($codsenha != $conf_senha){
            
                //EXECUTAR ERRO
              $codsenhaErr = "Senha incorreta";
            
            //CASO CPF INFORMADO SEJA DIFERENTE DO CADASTRADO
            }elseif($cpf != $conf_cpf){
                
                //EXECUTAR ERRO
              $codcpfErr = "CPF incorreto";
              
            //CASO SENHA E CPF FOR IGUAL AO CADASTRADO      
            }elseif(($codsenha = $conf_senha ) and ($cpf = $conf_cpf)){
        
            //VARIAVEL DE CONFIRMAÇÃO
            $valido = true;
            
            //CRIAR SESSÕES = CPF, CODSENHA E VALIDO 
            $_SESSION['log_cpf'] = $cpf;
            $_SESSION['log_senha'] = $conf_senha;
            $_SESSION['log_valido'] = $valido;
            
            //ENVIA DADOS PARA A PAGINA DE TESTES DO LOGIN
            header("location: PHP/test_log.php");
        }
            }
            
            }else{

            //CASO USUARIO ESTEJA BLOQUEADO GERAR UM ALERTA DE BLOQUEIO
            $invalido = "Seu usuario foi bloqueado, Favor tratar com o proprietario";
            echo "<script type='text/javascript'>alert('$invalido');</script>";
    
                }
}
} if(empty($cpf)){
    $invalido = "Voce deve estar logado para usar as paginas! caso ainda não tenha login clique em (Fazer cadastro)";
    echo "<script type='text/javascript'>alert('$invalido');</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="CSS/css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>login</title>
</head>

<body>
 <!--MENU-->
 <nav class="navbar navbar-expand-lg bg-dark navbar-dark ">
  <div class="logo">
    <img src="IMG/logo.jpg" width="70px" height="70">
  </div>
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">BLACKBEARD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="agendamento.php">Agendamento</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Outros
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="login.php">Login</a></li>
                <li><a class="dropdown-item" href="tp_corte.html">Tipos de Cortes</a></li>
                <li><a class="dropdown-item" href="cadastro.php">Cadastro</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="tclientes.php">tabela de cliente</a></li>
                <li><a class="dropdown-item" href="tagendamento.php">tabela de agendamentos</a></li>
              </ul>
            </li>
            <a href="PHP/sair.php" class="btn btn-danger ml-3">Sair da conta</a>
          </ul>
        </div>
      </div>
    </nav>
  <div id="titulos">
    <h2>BLACKBEARD - Login</h2>
    </div><br>
    
<!-- INSERINDO OS DADOS PARA O LOGIN -->
	<div class="login container w-50"><br>
    <form action="" method="POST">

	<div>
	    <!-- INSERE CPF -->
     Digite o CPF: 
     <div class="d-flex justify-content-center">
        <span class="text-danger h3"><?= $cpfErr ?></span>
     </div>
    <input class="form-control mt-3"  type="text" id="cpf" name="cpf" placeholder="CPF / 999.999.999-99" ><br>
    </div>
    <div>
        <!-- INSERE SENHA -->
    Digite a Senha:
    <div class="d-flex justify-content-center">
        <span class="text-danger h3"><?= $codsenhaErr ?></span>
    </div>
    <input class="form-control mt-3" type="password" id="codsenha" name="codsenha" placeholder="********" required maxlength="20"><br>
    </div>
      <div>
    <button class="btn btn-primary btn btn-dark w-50" type="inputSubmit" type="submit" name="submit">Acessar</button><br><br>
    </div><br>
    <div>
        <a class='btn btn-sm btn-danger' name='fcad' title='fcad' href="cadastro.php">Fazer cadastro</a>
    </div><br>
    </div>
  </form>
    <!-- script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="JS/jquery.mask.js"></script>
<script src="JS/js.js"></script>

</body>

</html>