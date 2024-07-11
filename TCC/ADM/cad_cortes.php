<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

//INICIA UMA SESSÃO
session_start();

//CASO SESSÃO DE CPF ESTIVER VAZIA
if(empty($_SESSION['log_cpf'])){
    
    //ENVIAR PARA LOGIN
    header("location: ../login.php");    
    
    
}
    //ADD CPF A VARIAVEL
    $cpf = $_SESSION['log_cpf'];

// CRIA UMA CONEXÃO COM O BANCO
include_once "../PHP/conexao.php";

//PEGA DADOS DO BANCO ONDE O CPF DA TB_LOGINS É IGUAL CPF INFORMADO
$sql = $conn->prepare("SELECT * FROM tb_usuarios WHERE us_tipo = 'adm'");            
$sql->execute();

//ASSOCIA OS DADOS DO BANCO A VARIAVEL
while ($test = $sql->fetch(PDO::FETCH_ASSOC)) {
    
    //RECEBE LOG_ADM
    $adm_log = $test['us_tipo'];
    
    //CASO ADM_LOG FOR SIM
    if ( $adm_log != 'adm') {

header("location: ../index.html"); 
}
}
    //VARIAVEIS PARA A VERIFICAÇÃO       
    $cabelo = $barba = "";
    $erro_cad = "";
  
    //FAZ VERIFICAÇOES DE VALIDAÇÃO DOS DADOS
    if(isset($_POST['submit'])){
    
     $cabelo = $_POST['cabelo'];
     $barba = $_POST['barba'];
    
    
    
        //FAZ VERIFICAÇOES DE VALIDAÇÃO DOS DADOS
        if($barba != null){
          
            //INSERE OS DADOS DO CLIENTE DENTRO DO BANCO 
            $sqlb = "INSERT INTO tb_corte_barba (tp_barba_nome) VALUES ('$barba')";
            
            //EXECUTA A AÇÃO
            $conn->exec($sqlb);
            
        }elseif($cabelo != null){    
            $sqlc = "INSERT INTO tb_corte_cabelo (tp_cabelo_nome) VALUES ('$cabelo')";
            
            //EXECUTA A AÇÃO
            $conn->exec($sqlc);
            
        }elseif(($cabelo != null) AND ($barba != null)){
            //INSERE OS DADOS DO CLIENTE DENTRO DO BANCO 
            $sqlb = "INSERT INTO tb_corte_barba (tp_barba_nome) VALUES ('$barba')";
            
            //EXECUTA A AÇÃO
            $conn->exec($sqlb);
            
             $sqlc = "INSERT INTO tb_corte_cabelo (tp_cabelo_nome) VALUES ('$cabelo')";
            
            //EXECUTA A AÇÃO
            $conn->exec($sqlc);
            
            header("location: ../tcortes_adm.php");
            
        }else{
            $erro_cad = "Obrigatorio 1 tipo de corte";
        }
    
    }
     
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    
    <title>cadastro</title>
<!--COR DO ERRO-->
<style>
.error {color: #FF0000;}
</style>

</head>
<body>
  <!--MENU-->
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark ">
  <div class="logo">
    <img src="../IMG/logo.jpg" width="70px" height="70">
  </div>
      <div class="container-fluid">
        <a class="navbar-brand" href="../index.html">BLACKBEARD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="../login.php">Login</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cadastros
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="cadastro_func.php">Cadastro de Funcionários</a></li>
                <li><a class="dropdown-item" href="cad_cortes.php">cadastro de cortes</a></li>
                <li><a class="dropdown-item" href="cad_horarios.php">cadastro de horarios</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Tabelas
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="thorarios_adm.php">tabela de horários</a></li>
                <li><a class="dropdown-item" href="tcortes_adm.php">tabela de Cortes</a></li>
                <li><a class="dropdown-item" href="tagendamento_adm.php">tabela de agendamentos</a></li>
                <li><a class="dropdown-item" href="t_adm.php">tabela de administradores</a></li>
                <li><a class="dropdown-item" href="tfuncionarios_adm.php">tabela de funcionários</a></li>
                <li><a class="dropdown-item" href="tclientes_adm.php">tabela de clientes</a></li>
              </ul>
            </li>
            <a href="../PHP/sair.php" class="btn btn-danger ml-3">Sair da conta</a>
          </ul>
        </div>
      </div>
    </nav>      
<!--CADASTRO-->
<form action="" method="POST"> 
<div id="titulos">
<h2>BLACKBEARD - Cadastro cortes</h2><br>
</div>
<div class="cadastro container w-50" >
   
<label class="form-label" for="senha" > <h5>Digite os nomes dos cortes:</h5> </label><span class="error"> *<?=$erro_cad ?></span>
   
<!-- INSERINDO OS DADOS PARA O CADASTRO -->
  <div>
    <label class="form-label" for="cabelo"><h5>Corte Cabelo:</h5>
    <input class="form-control" type="text" id="cabelo" name="cabelo">
  </div><br>

  <div>
    <label class="form-label" for="barba"><h5>Corte Barba:</h5> 
    <input class="form-control" type="text" id="barba" name="barba">
  </div><br>

  <div><!--EXECUTA AS VERIFICAÇÕES-->
    <button type="submit" class="btn btn-primary btn btn-dark w-50" type="submit" name="submit">CADASTRAR</button>
  </div>
  <br>
</div>
</form>
  <br>
  <br>


<!-- RODA PÉ -->
<footer class="bg-dark text-center text-white">
  <!-- CONTEINER  -->
  <div class="container p-4">
    <!-- QUEM SOMOS -->
    <section class="mb-4">
      <p>Somos uma empresa que atua no mercado de cortes de cabelo e barba, entregando os melhores serviços
    e tratamento para os nossos clientes e cooperados.
      </p>
    </section>
    

 <!-- MIDIAS SOCIAIS -->
    <section class="">
      

        <!--COLUNAS-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Contatos</h5>

          <ul class="list-unstyled mb-0">
            <li>
            <a class="btn btn-outline-light btn-floating m-1 " href="https://wa.me/<?php $sql = $conn->prepare("SELECT * FROM tb_usuarios WHERE us_tipo = 'atd'");            
           $sql->execute();
           
           while($user_data=$sql->fetch(PDO::FETCH_ASSOC)) {
           echo $user_data['us_tell']; 
            ?>" role="button"
              ><i class="fab fa-whatsapp"></i
           ></a> N° <?php echo $user_data['us_tell']; }?>
            </li>
           <li>
              <a class="btn btn-outline-light btn-floating m-1" href="https://pt-br.facebook.com/" role="button"
        ><i class="fab fa-facebook-f"></i></a> Barbearia.Black.Beard
            </li>
            <li>
             <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/" role="button"
        ><i class="fab fa-instagram"></i></a> @Barbearia.Black.Beard
            </li>
            <li>
              <a class="btn btn-outline-light btn-floating m-1" href="https://web.skype.com/" role="button"
        ><i class="fab fa-skype"></i></a> Barbearia.Black.Beard
            </li>
          </ul>
        </div>
        
    </section>
    
  </div>
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2020 Copyright:
    <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
  <!-- Copyright -->
</footer>


</body>
<!-- script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="JS/jquery.mask.js"></script>
<script src="JS/js.js"></script>
</html>
 