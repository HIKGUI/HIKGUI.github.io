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


    //VARIAVEIS P/ VERIFICAÇÕES DE ATUALIZAÇÕES NO CADASTRO DO CLIENTE
    
    $up_nome = $up_cpf = $up_tell = $up_dt_nasc = $up_sexo = $up_senha = $up_situacao = "";
    $up_nomeConf = $up_cpfConf = $up_tellConf = $up_dt_nascConf = $up_sexoConf = $up_senhaConf = $up_situacaoConf = false;
    $up_nomeErr = $up_cpfErr = $up_tellErr = $up_dt_nascErr = $up_sexoErr = $up_senhaErr = $up_situacaoErr = "";

    //CASO BOTAO SEJA PRESSIONADO EXECUTA VERIFICAÇOES 
    if(empty($_POST["update"])){
    
    
    //VERIFICA SE SITUAÇÃO ESTAVAZIA
    if(empty($_POST["up_situacao"])){
      $up_situacaoErr = "ATUALIZAR SITUAÇÃO ";
      
        //CONFIRMA A VARIAVEL PARA EXECUÇÃO
    }else{
        $up_situacao = $_POST['up_situacao'];
        $up_situacaoConf = true;

    }
}
    
    
    //PEGA O CPF DA URL DA PAGINA
    if($_GET['cpf']){
        
        //CONEXÃO COM BANCO
      include_once('../PHP/conexao.php');
      
        //ADD CPF A VARIAVEL
        $cpf = $_GET['cpf'];
        
            //PEGA TODOS OS DADOS DA TABELA DE CLIENTES ONDE O CPF INFORMADO É O MESMO QUE ESTA NA TABELA
            $sql = $conn->prepare("SELECT * FROM tb_usuarios WHERE us_cpf=$cpf");            
            $sql->execute();
            
            //ASSOCIA OS DADOS DO BANCO A VARIAVEL
            while($user_data = $sql->fetch(PDO::FETCH_ASSOC)) {


                //RECEBE CPF
                $up_cpf = $user_data['us_cpf'];
                
                //RECEBE NOME
                $up_nome = $user_data['us_nome'];
                
                //RECEBE TELEFONE
                $up_tell = $user_data['us_tell'];
                
                //RECEBE DATA DE NASCIMENTO
                $up_dt_nasc = $user_data['us_dat_nasc'];
                
                //RECEBE SEXO
                $up_sexo = $user_data['us_sexo'];
                
                //RECEBE SITUAÇÃO
                $up_situacao = $user_data['us_situacao'];

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

<style>
.error {color: #FF0000;}
</style>

</head>
<body>
  
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
                <li><a class="dropdown-item" href="thorarios_adm.php">tabela de horarios</a></li>
                <li><a class="dropdown-item" href="tcortes_adm.php">tabela de Cortes</a></li>
                <li><a class="dropdown-item" href="tagendamento_adm.php">tabela de agendamentos</a></li>
                <li><a class="dropdown-item" href="t_adm.php">tabela de administradores</a></li>
                <li><a class="dropdown-item" href="tfuncionarios_adm.php">tabela de funcionarios</a></li>
                <li><a class="dropdown-item" href="tclientes_adm.php">tabela de clientes</a></li>
              </ul>
            </li>
            <a href="../PHP/sair.php" class="btn btn-danger ml-3">Sair da conta</a>
          </ul>
        </div>
      </div>
    </nav> 
      <!--menus fim-->
<form action="saveEdit_adm.php" method="POST"> 
<div id="titulos">
<h2>BLACKBEARD - Atualizar Cadastro</h2><br>
</div>
<div class="cadastro container w-50" >
   <!--ATUALIZAÇÕES P/ CADASTRO-->
   
   <p><span class="error">* Itens Obrigatórios</span></p>
   <form method="post" action="">  
   
<!-- INSERINDO OS DADOS PARA ATUALIZAR O CADASTRO -->
  <div>
    <label class="form-label" for="up_cpf" >CPF: </label><span class="error"> *<?=$up_cpfErr ?></span>
    <input class="form-control" type="text" id="up_cpf" name="up_cpf" value=<?php echo $up_cpf;?> readonly >
  </div>
  <div>
    <label class="form-label" for="up_nome">Nome: </label><span class="error"> *<?=$up_nomeErr ?></span>
    <input class="form-control" type="text" id="up_nome" name="up_nome" value=<?php echo $up_nome;?> readonly>
  </div>
  <div>
    <label class="form-label" for="up_tell" >Telefone: </label><span class="error"> *<?=$up_tellErr ?></span>
    <input class="form-control" id="up_tell" name="up_tell" value=<?php echo $up_tell;?> readonly>
  </div>
  <div>
	 <label class="form-label" for="up_dt_nasc" > Data de Nascimento: </label><span class="error"> *<?=$up_dt_nascErr ?></span>
   <input class="form-control" type="date" id="up_dt_nasc" name="up_dt_nasc" value=<?php echo $up_dt_nasc;?> readonly>
  </div>
  <div>
    <label class="form-label" for="up_senha" >Senha: </label><span class="error"> *<?=$up_senhaErr ?></span>
    <input class="form-control" id="up_senha" name="up_senha" value=<?php echo $up_senha;?> >
  </div>
  <div>
    <label> <h4>ATIVO / BLOQUEADO</h4><span class="error"> </label><span class="error"> *<?=$up_situacaoErr ?></span><br>
    <input type="radio" id="up_situacao" name="up_situacao" value="atv" <?php echo ($up_situacao == 'atv') ? 'checked' : '';?> required>
    <label for="atv">ativo</label>
    <br>
    <input type="radio" id="up_situacao" name="up_situacao" value="blk" <?php echo ($up_situacao == 'blk') ? 'checked' : '';?> required>
    <label for="blk">bloqueado</label>
    <br>    
  </div>
  <div><!--EXECUTA AS VERIFICAÇÕES-->
    <button type="submit" class="btn btn-primary btn btn-dark w-50" type="submit" name="update">atualizar</button>
  </div>
  <br>
  
</div>
<br>
</form>


<!-- Footer -->
<footer class="bg-dark text-center text-white">
  <!-- Grid container -->
  <div class="container p-4">
    <!-- Section: Social media -->
    <section class="mb-4">
      <p>Somos uma empresa que atua no mercado de cortes de cabelo e barba, entregando os melhores serviços
    e tratamento para os nossos clientes e cooperados.
      </p>
    </section>
    <!-- Section: Text -->

 <!-- Section: Social media -->
    <section class="">
      

        <!--Grid column-->
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
        <!--Grid column-->
      <!--Grid row-->
    </section>
    <!-- Section: Text -->
  </div>
  <!-- Grid container -->
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2020 Copyright:
    <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

<!-- script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="JS/jquery.mask.js"></script>
<script src="JS/js.js"></script>
</body>
</html>
 