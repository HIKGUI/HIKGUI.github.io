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
    <link rel="stylesheet" href="CSS/css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
 <!--menus-->
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
<div id="titulos">
  <h2>BLACKBEARD - Agendamentos</h2>
</div>

<div class=" table-responsive container w-70 p-2">
    <!--CRIA UMA TABELA COM AS INFORMAÇÕES-->
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">CODIGO</th>
                    <th scope="col">NOME DO FUNCIONÁRIO</th>
                    <th scope="col">DATA</th>
                    <th scope="col">HORA</th>
                    <th scope="col">TIPO DO CORTE (CABELO)</th>
                    <th scope="col">TIPO DO CORTE (BARBA)</th>                                        
                    <th scope="col">TIPO DO PAGAMENTO</th>
                    <th scope="col">OBSERVAÇÕES</th>
                    <th scope="col">DELETAR</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php        
                
                //CONEXÃO COM O BANCO
                include_once('PHP/conexao.php'); 
                
                //PEGA DADOS DO BANCO ONDE O CPF DA TB_LOGINS É IGUAL CPF INFORMADO
                $sql = $conn->prepare("SELECT * FROM tb_usuarios WHERE us_tipo = 'cli'");            
                $sql->execute();
                
                //ASSOCIA OS DADOS DO BANCO A VARIAVEL
                while ($test = $sql->fetch(PDO::FETCH_ASSOC)) {
                    
                    //RECEBE LOG_ADM
                    $adm_log = $test['us_tipo'];
                    
                    //CASO ADM_LOG FOR NÃO
                    if ( $adm_log === 'cli') {

                        //PEGA APENAS OS DADOS ONDE O CPF INFORMADO SEJA O MESMO INSERIDO TABELA
                      $sql = $conn->prepare("SELECT tb_agendamentos.ag_cort_barba, tb_agendamentos.ag_cort_cabelo, tb_corte_barba.tp_barba_nome, tb_corte_cabelo.tp_cabelo_nome, tb_agendamentos.log_cod_ag, tb_usuarios.us_nome, ag_cod, ag_data, ag_hora, ag_tp_pag, ag_obs FROM tb_agendamentos INNER JOIN tb_corte_barba ON ag_cort_barba = tp_barba_cod INNER JOIN tb_corte_cabelo ON ag_cort_cabelo = tp_cabelo_cod INNER JOIN tb_usuarios ON func_cod_ag = us_cpf WHERE log_cod_ag = $cpf ORDER BY ag_cod DESC");
                      $sql->execute();
                      
                    }
                        

                //ASSOCIA OS DADOS DO BANCO A VARIAVEL
                while($user_data=$sql->fetch(PDO::FETCH_ASSOC)) {
                    
                    
                  ?>
                         <tr>
                            <!--MOSTRA O CODIGO DO AGENDAMENTO-->
                          <td><?php echo $user_data['ag_cod']; ?></td>
                          
                          <!--MOSTRA O NOME DO CLIENTE-->
                          <td><?php echo $user_data['us_nome']; ?></td>
                          
                            <!--MOSTRA A DATA DO AGENDAMENTO PADRAO BRASILEIRO-->
                          <td><?php echo date("d/m/Y", strtotime($user_data['ag_data'])); ?></td>
                          
                            <!--MOSTRA A HORA DO AGENDAMENTO-->
                          <td><?php echo date("h:i", strtotime($user_data['ag_hora'])); ?></td>
                          
                            <!--MOSTRA O TIPO DE CORTE (CABELO) ESCOLHIDO P/ AGENDAMENTO-->
                          <td><?php echo $user_data['tp_cabelo_nome']; ?></td>
                          
                            <!--MOSTRA O TIPO DE CORTE (BARBA) ESCOLHIDO P/ AGENDAMENTO-->
                          <td><?php echo $user_data['tp_barba_nome']; ?></td>
                          
                            <!--MOSTRA O TIPO DE PAGAMENTO ESCOLHIDO P/ AGENDAMENTO-->
                          <td><?php echo $user_data['ag_tp_pag']; ?></td>
                          
                            <!--MOSTRA O CODIGO DO AGENDAMENTO-->
                          <td><?php echo $user_data['ag_obs']; ?></td>
                          
                            <!--CRIA UM BOTÃO PARA DELETAR O AGENDAMENTO-->
                          <td>
                              
                              <a class='btn btn-sm btn-danger' name='del' title='Deletar' href=" <?php echo "PHP/delete_ag.php?ag_cod={$user_data['ag_cod']}";?>">
                          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                          <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                          </svg>
                          </a></td>
                          
                        </tr>
                  <?php      
                  
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
<script src="JS/js.js"></script>

</body>

</html>