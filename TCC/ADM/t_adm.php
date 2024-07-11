<?php
/* ADAPTADO DE:

https://www.youtube.com/c/GustavoNeitzke 

*/

//INICIA UMA SESSÃO
session_start();

//CASO SESSÃO DE CPF ESTIVER VAZIA
if(empty($_SESSION['log_cpf'])){
    
    //ENVIAR PARA LOGIN
    header("location: login.php");    
    
    
}
    //ADD CPF A VARIAVEL
    $cpf = $_SESSION['log_cpf'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../CSS/css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
 <!--menus-->
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
<div id="titulos">
  <h2>BLACKBEARD - Administradores</h2>
</div>

<div class="table-responsive container w-70 p-2">
<!--CRIA UMA TABELA COM AS INFORMAÇÕES-->
    
<form action="" method="POST">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
            <fomr>
  <div class="form-group container w-70 p-2">
    <input type="text" class="form-control" id="dados_adm" name="dados_adm" placeholder="Digite o nome do ADM">
    <button class="btn btn-primary" type="submit" name="pesquisar">PESQUISAR</button>
  </div>
</fomr>
                </tr>
                <tr>
                    <th scope="col">CPF</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Sexo</th> 
                    <th scope="col">Situação</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php                
                //CONEXÃO COM O BANCO
                include_once('../PHP/conexao.php'); 
                
                //PEGA DADOS DO BANCO CASO ONDE US = ADIMINISTRADOR 
                $sql = $conn->prepare("SELECT * FROM tb_usuarios WHERE us_tipo = 'adm'");            
                $sql->execute();
                
                //ASSOCIA OS DADOS DO BANCO A VARIAVEL
                while ($test = $sql->fetch(PDO::FETCH_ASSOC)) {
                
                    //RECEBE LOG_ADM
                    $adm_log = $test['us_tipo'];
                    
                        //CASO ADM_LOG FOR SIM
                    if ( $adm_log === 'adm') {
                    
                        
                    if(isset($_POST['pesquisar'])){
                        
                    $dados_adm = $_POST['dados_adm'];
                     
                    if($dados_adm != null){
                    
                      $sql = $conn->prepare("SELECT case us_sexo when 'm' then 'Masculino' else 'Feminino' end As compl_sexo, case us_situacao when 'blk' then 'Bloqueado' else 'Ativo' end As compl_sit, us_nome, us_tell, us_dat_nasc, us_cpf, us_situacao FROM tb_usuarios where us_nome like '%$dados_adm%' and us_tipo = 'adm'");            
                      $sql->execute();
                    
                   }else{
                     //PEGA TODOS OS DADOS DA TABELA DE CLIENTES
                      $sql = $conn->prepare("SELECT case us_sexo when 'm' then 'Masculino' else 'Feminino' end As compl_sexo, case us_situacao when 'blk' then 'Bloqueado' else 'Ativo' end As compl_sit, us_nome, us_tell, us_dat_nasc, us_cpf, us_situacao FROM tb_usuarios where us_tipo = 'adm'");
                      $sql->execute();
                   }
                
                //ASSOCIA OS DADOS DO BANCO A VARIAVEL
                while($user_data=$sql->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                         <tr>
                             <!--MOSTRA CPF DO CLIETNE-->
                          <td><?php echo $user_data['us_cpf']; ?></td>
                            
                             <!--MOSTRA O NOME DO CLIENTE-->
                          <td><?php echo $user_data['us_nome']; ?></td>
                          
                             <!--MOSTRA O TELEFONE DO CLIENTE-->
                          <td><?php echo $user_data['us_tell']; ?></td>
                          
                             <!--MOSTRA DATA DE NASCIMENTO DO CLIENTE-->
                          <td><?php echo date("d/m/Y", strtotime($user_data['us_dat_nasc'])); ?></td>
                          
                             <!--MOSTRA O SEXO-->
                          <td><?php echo $user_data['compl_sexo']; ?></td>
                          
                             <!--MOSTRA SITUAÇÃO DO CLIENTE-->
                          <td><?php echo $user_data['compl_sit']; ?></td>
                          <td>

                          <!--CRIA UM BOTÃO QUE TORNA ADM EM FUNCIOÁRIO-->
                        <a class='btn btn-sm btn-secondary' title='Tornar FUNCIOÁRIO' href=" <?php echo "saveUp_func.php?cpf={$user_data['us_cpf']}";?>">
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-controller' viewBox='0 0 16 16'>
                        <path d='M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1v-1z'/>
                        <path d='M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .433-.335.504.504 0 0 1-.028-.079zm2.036.412c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.504C4.861 9.969 5.978 9.027 8 9.027s3.139.942 3.965 1.855c.164.181.307.348.44.504.214.251.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z'/>
                        </svg>
                        </a> 
                              
                             <!--CRIA UM BOTÃO QUE LEVA PARA A PAGINA DE EDIÇÃO DOS DADOS-->
                          <a class='btn btn-sm btn-primary' title='Editar' href=" <?php echo "up_adm.php?cpf={$user_data['us_cpf']}";?>">
                          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                          <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                          </svg>
                          </a> 
                          
                              <!--CRIA UM BOTÃO QUE PERMITE DELETAR OS DADOS-->
                          <a class='btn btn-sm btn-danger' name='del' title='Deletar' href=" <?php echo "delete/delete_all.php?cpf={$user_data['us_cpf']}";?>">
                          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                          <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                          </svg>
                          </a>
                          </td>
                        </tr>
                  <?php
                    }
                  }
                  }      
                    }
                
                    ?>
            </tbody>
        </table>
    </div>
<br>
<br>

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
<script src="../JS/jquery.mask.js"></script>
<script src="../JS/js.js"></script>

</body>

</html>