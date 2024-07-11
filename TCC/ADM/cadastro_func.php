<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

//valida cpf
//https://gist.github.com/rafael-neri/ab3e58803a08cb4def059fce4e3c0e40
*/

// CRIA UMA CONEXÃO COM O BANCO
include_once "../PHP/conexao.php";

    //VARIAVEIS PARA A VERIFICAÇÃO
    $nome = $cpf = $tell = $dtnasc = $sexo = $senha = "";
    $nomeConf = $cpfConf = $tellConf = $dtnascConf = $sexoConf = $senhaConf = false;
    $nomeErr = $cpfErr = $tellErr = $dtnascErr = $sexoErr = $senhaErr = "";


    //CASO BOTAO SEJA PRESSIONADO EXECUTA VERIFICAÇOES 
    if(isset($_POST['submit'])){

      //VERIFICA SE CPF ESTA VAZIO
  if(empty($_POST["cpf"])){
      $cpfErr = " CPF OBRIGATÓRIO";
      
      //CONFIRMA A VARIAVEL PARA EXECUÇÃO
  }else{
        
    //FAZ UM FILTRO NOS DADO PARA SEREM VERIFICADOS
  $cpf = filter_input(INPUT_POST,'cpf');
  
  //REMOVE CARACTERES ESPECIAIS DO CPF
  function limp_cpf($cpf){
  $res1 = preg_replace('/[^0-9]/', '', $cpf);
  return $res1;
      
  }
  $cpf = limp_cpf($cpf);
 
  if(!empty($_POST["cpf"])){
     
      for ($t = 9; $t < 11; $t++) {
    
    for ($d = 0, $c = 0; $c < $t; $c++) {
      $d += $cpf[$c] * (($t + 1) - $c);
    }
    $d = ((10 * $d) % 11) % 10;
    if ($cpf[$c] != $d) {
      $cpfErr = "CPF invalido";
    }
  } 

}

    //BUSCA O CPF NO BANCO
  $sql = $conn->prepare("SELECT us_cpf FROM tb_usuarios WHERE us_cpf = '$cpf'");
  $sql->execute();
  $duplcpf = $sql->rowCount();

    //CASO HAJA ALGUM CPF JA CADASTRADO
  if( $duplcpf >= 1) {
    $cpfErr = " ESTE CPF JÁ ESTA CADASTRADO";          

  }else{
    //RECEBE O CPF ESCRITO
    $cpf = $cpf;
    $cpfConf = true;
  }
      
      //VERIFICA SE NOME ESTA VAZIO
  }if(empty($_POST["nome"])){
    $nomeErr = " NOME OBRIGATÓRIO";

  }else{
    
    //FAZ UM FILTRO NOS DADO PARA SEREM VERIFICADOS
  $nome = filter_input(INPUT_POST,'nome');
    
    //BUSCA O NOME NO BANCO
  $sql = $conn->prepare("SELECT us_nome FROM tb_usuarios WHERE us_nome = '$nome'");
  $sql->execute();
  $duplnome = $sql->rowCount();

    //CASO HAJA ALGUM NOME JA CADASTRADO
  if( $duplnome >= 1) {
    $nomeErr = " ESTE NOME JÁ ESTA CADASTRADO";          

  }else{
    //RECEBE O NOME ESCRITO
    $nome = $_POST['nome'];
    $nomeConf = true;
  }

  //VERIFICA SE TELEFONE ESTA VAZIO
  }if(empty($_POST["tell"])){
      $tellErr = " TELEFONE OBRIGATÓRIO";
      
      //CONFIRMA A VARIAVEL PARA EXECUÇÃO
  }else{
    
    //FAZ UM FILTRO NOS DADO PARA SEREM VERIFICADOS
  $tell = filter_input(INPUT_POST,'tell');

    //REMOVE CARACTERES ESPECIAIS DO TELEFONE
  function limp_tell($tell){
    $res3 = preg_replace('/[^0-9]/', '', $tell);
    return $res3;
        
    }
    $tell = limp_tell($tell);
  
    //BUSCA O TELEFONE NO BANCO    
  $sql = $conn->prepare("SELECT us_tell FROM tb_usuarios WHERE us_tell = $tell");
  $sql->execute();
  $dupltell = $sql->rowCount();

    //CASO HAJA ALGUM TELEFONE JA CADASTRADO
  if( $dupltell >= 1) {
    $tellErr = " ESTE TELEFONE JÁ ESTA CADASTRADO";          

  }else{
    //RECEBE O TELEFONE ESCRITO
    $tell = $tell;
    $tellConf = true;
  }
      
      //VERIFICA SE DATA DE NASCIMENTO ESTA VAZIO
  }if(empty($_POST["dtnasc"])){
      $dtnascErr = " DATA DE NASCIMENTO OBRIGATÓRIA";
      
      //CONFIRMA A VARIAVEL PARA EXECUÇÃO
  }else{
      $dtnasc = $_POST['dtnasc'];
      $dtnascConf = true;

      //VERIFICA SE O SEXO ESTA VAZIO
  }if(empty($_POST["sexo"])){
      $sexoErr = " DIGITE O SEXO";
      
      //CONFIRMA A VARIAVEL PARA EXECUÇÃO
  }else{
      $sexo = $_POST['sexo'];
      $sexoConf = true;

      //VERIFICA SE O SENHA ESTA VAZIA
  }if(empty($_POST["senha"])){
      $senhaErr = " SENHA OBRIGATÓRIO";
      
      //CONFIRMA A VARIAVEL PARA EXECUÇÃO
  }else{
      $senha = $_POST['senha'];
      $senha = md5($senha);
      $senhaConf = true;

  }
  }
    
    
    //FAZ VERIFICAÇOES DE VALIDAÇÃO DOS DADOS
    if(isset($_POST['submit']))
        
            //FAZ VERIFICAÇOES DE VALIDAÇÃO DOS DADOS
        if(($nomeConf === true) and ($cpfConf === true) and ($tellConf === true) and ($dtnascConf === true) and ($senhaConf === true)){
          
            //INSERE OS DADOS DO CLIENTE DENTRO DO BANCO 
            $sql = "INSERT INTO tb_usuarios (us_cpf, us_nome, us_tell, us_dat_nasc, us_sexo, us_senha, us_situacao, us_tipo) VALUES ($cpf, '$nome', $tell, '$dtnasc', '$sexo', '$senha', 'atv', 'func')";
            
            //EXECUTA A AÇÃO
            $conn->exec($sql);
            
            //INSERE OS DADOS DO FUNCIONARIOS DENTRO DO BANCO COMO ADMIN
            if($cpf != null){
            
            //ENVIA USUARIO APARA APAGINA DOS AGENDAMENTOS
            header("location: tfuncionarios_adm.php");
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
      
<!--CADASTRO-->
<form action="" method="POST"> 
<div id="titulos">
<h2>BLACKBEARD - Cadastro Funcionarios</h2><br>
</div>
<div class="cadastro container w-50" >
   
<!-- INSERINDO OS DADOS PARA O CADASTRO -->
   <label><h4>Itens Obrigatorios</label><span class="error"> * </h4></span>
   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><br>

  <div>
    <label class="form-label" for="cpf" ><h5>Digite cpf:</h5> </label><span class="error"> *<?=$cpfErr ?></span>
    <input class="form-control" type="text" id="cpf" name="cpf" placeholder="999.999.999-99" >
  </div>
  <div>
    <label class="form-label" for="nome"><h5>Digite o nome:</h5> </label><span class="error"> *<?=$nomeErr ?></span>
    <input class="form-control" type="text" id="nome" name="nome">
  </div>
  <div>
    <label class="form-label" for="tell" ><h5>Digite um telefone:</h5> </label><span class="error"> *<?=$tellErr ?></span>
    <input class="form-control" type="text" id="tell" name="tell" placeholder="(99)9-9999-9999" >
  </div>
  <div>
	 <label class="form-label" for="dtnasc" > <h5>Digite Data de Nascimento: </h5></label><span class="error"> *<?=$dtnascErr ?></span>
   <input class="form-control" type="date" id="dtnasc" name="dtnasc">
  </div>
  <div>
    <label> <h5>Marque seu sexo</h5><span class="error"> </label><span class="error"> *<?=$sexoErr ?></span><br>
    <input type="radio" id="sexo" name="sexo" value="f" required>
    <label for="f">Feminino</label>
    <br>
    <input type="radio" id="sexo" name="sexo" value="m" required>
    <label for="m">Masculino</label>
    <br>    
  </div>
  <div>
    <label class="form-label" for="senha" > <h5>Digite uma senha:</h5> </label><span class="error"> *<?=$senhaErr ?></span>
    <input class="form-control" type="text" id="senha" name="senha" required maxlength="20">
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
<script src="../JS/jquery.mask.js"></script>
<script src="../JS/js.js"></script>
</html>
 