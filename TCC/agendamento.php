<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

// CRIA UMA CONEXÃO COM O BANCO
include_once "PHP/conexao.php";

//BUSCA A SESSÃO DE LOGIN
session_start();

    //VERIFICA SE A SESSÃO ESTA VAZIA
if(empty($_SESSION['log_cpf'])){
    //ENVIA USUARIO APARA APAGINA DE LOGIN
    header("location: login.php");    
    
    
}   // VARIAVEL RECEBE O LOGIN DA SESSÃO
    $cpf = $_SESSION['log_cpf'];

    
    //VARIAVEIS PARA A VERIFICAÇÃO
    $ag_data = $ag_hora = $tp_pag = $tp_corte = $corte_cabelo = $corte_barba = $ag_obs = $func = "";
    $ag_dataConf = $ag_horaConf = $tp_pagConf = $tp_corteConf = $funcConf = false;
    $ag_dataErr = $ag_horaErr = $tp_pagErr = $tp_corteErr = $funcErr = "";
    
    //RECEBE A DATA DE HOJE
    $data = date('Y-m-d');
    
    //TRANSFORMA EM NUMEROS "REAIS"
    $data = strtotime($data);
    
    //CASO BOTAO SEJA PRESSIONADO EXECUTA VERIFICAÇOES 
    if(isset($_POST['submit'])){
    
      //RECEBE A DATA ESCOLHIDA PARA O AGENDAMENTO
      $ag_data = $_POST['ag_data'];
       
      //TRANSFORMA EM NUMEROS "REAIS"
      $ag_data = strtotime($ag_data);
      
      //VERIFICA SE DATA ESTA VAZIA
    if(empty($_POST["ag_data"])){
      $ag_dataErr = " DATA OBRIGATÓRIA";
        
      //VERIFICA SE A DATA É MAIOR OU IGUA QUE DATA DE HOJE
    }elseif( $ag_data >= $data){
      $ag_data = $_POST['ag_data'];
      
      //CONFIRMA A VARIAVEL PARA EXECUÇÃO
      $ag_dataConf = true;      
      
    }else{
      //GERA UM ERRO CASO A DATA SEJA MENOR QUE DATA DE HOJE
      $ag_dataErr = " DATA INVALIDA";
    
     //VERIFICA SE HORA ESTA VAZIA
    }if(empty($_POST["ag_hora"])){
      $ag_horaErr = " HORA OBRIGATÓRIO";
    
     //CASO HORA NÃO SEJA VAZIA ADD NA VARIAVEL
    }else{
      $ag_hora = $_POST["ag_hora"];
      $ag_horaConf = true;
        
     //VERIFICA SE TP DE PAG ESTA VAZIO
    }if(empty($_POST["tp_pag"])){
      $tp_pagErr = " TIPO DE PAGAMENTO OBRIGATÓRIO";
     
     //CASO TP DE PAG NÃO SEJA VAZIO ADD NA VARIAVEL
    }else{
      $tp_pag= $_POST['tp_pag'];
      $tp_pagConf = true;
    
      //VERIFICA SE OBS ESTA VAZIO
    }if(!empty($_POST["ag_obs"])){
      $ag_obs = $_POST["ag_obs"];
      
      //VERIFICA SE TP DE CORTE FOI ANEXADO VALOR
    }if(isset($_POST["corte_cabelo"])){
      $corte_cabelo = $_POST['corte_cabelo'];
      
      
      //VERIFICA SE TP DE BARBA FOI ANEXADO VALOR
    }if(isset($_POST["corte_barba"])){
      $corte_barba = $_POST['corte_barba'];
      
      
    }if(($corte_barba != 0) OR ($corte_cabelo != 0)){
        $tp_corteConf = true;
        
    }else{
        $tp_corteErr = "Obrigatorio selecionar 1 tipo de corte";
    }if(empty($_POST["select_func"])){
        $funcErr = " OBRIGATÓTIO A ESCOLHA DE UM FUNCIONÁRIO ";
    }
        $func = $_POST['select_func'];
        $funcConf = true;
    }
  
        //FAZ VERIFICAÇOES DE VALIDAÇÃO DOS DADOS
        if(($ag_dataConf === true) and ($ag_horaConf === true) and ($funcConf === true) and ($tp_pagConf === true) and ($tp_corteConf === true)){
            
            //INSERE UM AGENDAMENTO DENTRO DO BANCO

            $sql = "INSERT INTO tb_agendamentos ( ag_data, ag_hora, ag_cort_cabelo, ag_cort_barba, ag_tp_pag, ag_obs, log_cod_ag, func_cod_ag)
            VALUES ( '$ag_data', '$ag_hora', $corte_cabelo, $corte_barba, '$tp_pag', '$ag_obs', $cpf, $func)";

            
            //EXECUTA A AÇÃO
            $conn->exec($sql);

                
            
            $sql = "UPDATE tb_horarios SET hr_disponivel = 'f' WHERE hr_hora = '$ag_hora' AND hr_func_cod = $func";
            $conn->exec($sql);
            
           //ENVIA USUARIO APARA  DOS AGENDAMENTOS

            header("location: tagendamento.php"); 
            }
  

            

        
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC</title>
    <link rel="stylesheet" href="CSS/css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    
<!--COR DO ERRO-->
<style>
.error {color: #FF0000;}
</style>    
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
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="cadastro.php">Cadastro</a></li>
                <li><a class="dropdown-item" href="tclientes.php">tabela de cliente</a></li>
                <li><a class="dropdown-item" href="tagendamento.php">tabela de agendamentos</a></li>
              </ul>
            </li>
            <a href="PHP/sair.php" class="btn btn-danger ml-3">Sair da conta</a>
          </ul>
        </div>
      </div>
    </nav>


<!--AGENDAMENTO-->
<form action="" method="post">
<div id="titulos">
<h2> BLACKBEARD - Agendamento</h2><br>
</div>
<div class="agendamento container w-50">

<div>
	<label class="form-label" for="select_func" ><h4> Selecione um funcionário: </h4></label><span class="error"> *<?=$funcErr ?><br>
<div>
    
<select id="select_func" name="select_func">
<option value="">FUNCIONÁRIOS</option>
  <?php 
  $func = "";
  
  //INFORMA O CODIGO TP CORTE P/ OPÇÕES (CABELO)
  
  //PEGA DADOS DA TABELA tb_usuarios
  $stmt = $conn->prepare("SELECT * FROM tb_usuarios WHERE us_tipo = 'func'");
  $stmt->execute();
  
  //CASO HAJA MAIS DE 1 LINHA EXECUTAR
 
      
      //ASSOCIA OS DADOS A VARIAVEL
    while($teste = $stmt->fetch(PDO::FETCH_ASSOC)){
     
     
      ?>
      <!--RECOLHE OS DADOS (ADD O CODIGO E MOSTRA O NOME DOS MESMOS)-->
      <option value= "<?php print_r($teste['us_cpf']); ?>">
      <?php echo $teste['us_nome'];?></option>
   
      <?php
    }
    $func = $_POST['select_func'];
     
  ?>
    
</select>
</div><br>
<!-- INSERE OS HORA -->

<div>
	<label class="form-label" for="ag_hora" ><font color="black"><h4> Selecione a hora desejada: </h4></font></label><span class="error"> *<?=$ag_horaErr ?><br>
</div>
<div>
    
<select id="ag_hora" name="ag_hora">
<option value="">HORÁRIOS DISPONÍVEIS</option>
  <?php 
if(isset($_POST['pesquisa'])){

  //INFORMA AS HORAS DISPONIVEIS
  //PEGA DADOS DA TABELA tb_horarios
  
  
  $sql = $conn->prepare("SELECT tb_horarios.hr_func_cod, tb_usuarios.us_nome, hr_cod, hr_hora, hr_disponivel FROM tb_usuarios INNER JOIN tb_horarios ON hr_func_cod = us_cpf WHERE hr_func_cod = $func AND hr_disponivel = 'v' ");            
        $sql->execute();
  
  //CASO HAJA MAIS DE 1 LINHA EXECUTAR
      if($func = 'hr_func_cod'){
      //ASSOCIA OS DADOS A VARIAVEL
    while($dados = $sql->fetch(PDO::FETCH_ASSOC)){
     
      ?>
      <!--RECOLHE OS DADOS (ADD O CODIGO E MOSTRA O NOME DOS MESMOS)-->
      <option value= "<?php print_r($dados['hr_hora']); ?>">
      <?php echo date("h:i", strtotime($dados['hr_hora']));?></option>
   
      <?php
    }
    }
  
}
  ?>
  
</select>

</div>
<br>

<div><!--EXECUTA AS VERIFICAÇÕES-->
    <button type="submit" class="btn btn-primary btn btn-dark w-50" name="pesquisa">Pesquisar</button>
  </div><br>
  
<!-- INSERINDO OS DADOS PARA O AGENDAMENTO -->
<div>
	<label class="form-label" for="ag_data" ><font color="black"><h4> Selecione a data desejada: </h4><font></font></label><span class="error"> *<?=$ag_dataErr ?>
<!-- INSERE OS DATA -->
    <input class="form-control" type="date" id="ag_data" name="ag_data" >
</div>
<br>

    
</div>
<br>

<div>
<!-- INSERE OS TP DE PAGAMENTO -->
    <label> <h4>Tipos de pagamento</h4></label><span class="error"> *<?=$tp_pagErr ?></span><br>
    <input type="radio" id="tp_pag" name="tp_pag" value="Dinheiro" >
    <label for="tp_pag">Dinheiro</label>
    <br>
    <input type="radio" id="tp_pag" name="tp_pag" value="Cartao" >
    <label for="tp_pag">Cartão</label>
    <br>
    <input type="radio" id="tp_pag" name="tp_pag" value="Pix" >
    <label for="tp_pag">Pix</label>
    <br>    
  </div>
<br>
<div>
<!-- INSERE TP DE CORTE -->
<label for="tp_corte" name="tp_corte"><h4> escolha o tipo do corte </h4></label><span class="error"> *<?=$tp_corteErr ?></span><br>

<select id="corte_cabelo" name="corte_cabelo">
<option value="0">CABELO</option>
  <?php 
  
  //INFORMA O CODIGO TP CORTE P/ OPÇÕES (CABELO)
  
  //PEGA DADOS DA TABELA tb_corte_cabelo
  $stmt = $conn->prepare("SELECT * FROM tb_corte_cabelo WHERE tp_cabelo_cod > 0");
  $stmt->execute();
  
  //CASO HAJA MAIS DE 1 LINHA EXECUTAR
  if($stmt->rowCount() > 0 ){
      
      //ASSOCIA OS DADOS A VARIAVEL
    while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
     
      ?>
      <!--RECOLHE OS DADOS (ADD O CODIGO E MOSTRA O NOME DOS MESMOS)-->
      <option value= "<?php print_r($dados['tp_cabelo_cod']); ?>">
      <?php echo $dados['tp_cabelo_nome'];?></option>
   
      <?php
    
    }
  }
  ?>
  
</select>
<select id="corte_barba" name="corte_barba">
<option value="0">BARBA</option>
  <?php 
  
  //INFORMA O CODIGO TP CORTE P/ OPÇÕES (BARBA)
  
  //PEGA DADOS DA TABELA tb_corte_barba
  $stmt = $conn->prepare("SELECT * FROM tb_corte_barba WHERE tp_barba_cod > 0");
  $stmt->execute();
  
  //CASO HAJA MAIS DE 1 LINHA EXECUTAR
  if($stmt->rowCount() > 0 ){
      
      //ASSOCIA OS DADOS A VARIAVEL
    while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
        
     ?>
     
     <!--RECOLHE OS DADOS (ADD O CODIGO E MOSTRA O NOME DOS MESMOS)-->
      <option value= "<?php print_r($dados['tp_barba_cod']); ?>">
      <?php echo $dados['tp_barba_nome']; ?></option>
   
      <?php
    }
  }
  
  ?>
</select>
</div>
<br>
<!--USUARIO PODE COLCOLOCAR UMA OBSERVAÇÃO PARA FAZER O CORTE-->
<textarea name="ag_obs" placeholder="OBS Para o Corte"></textarea>
<br><br>
  <div><!--EXECUTA AS VERIFICAÇÕES-->
    <button type="submit" class="btn btn-primary btn btn-dark w-50" type="submit" name="submit">Agendar</button>
  </div><br>
  </div><br>
</form>

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

</body>

</html>