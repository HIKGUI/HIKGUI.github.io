<?php/*
    //PEGA  O CPF DO CLIENTE
    if(!empty($_GET['cpf']))
    {
        
        include_once('conexao.php');
        $cpf = $_GET['cpf'];

        
        if($result = $cpf){
            
            // BUSCA UMA CONEXÃO QUE SELECIONAR O CLIENTE
            
            $sql = $conn->prepare("SELECT * FROM tb_clientes WHERE cli_cpf = $cpf");            
            $sql->execute();
            
            //CRIA UM ARRAY QUE PEGA AS INFORMAÇÕES DOS CLIENTES
            while($user_data = $sql->fetch(PDO::FETCH_ASSOC)) {

                $cpf = $user_data['cli_cpf'];
                $nome = $user_data['cli_nome'];
                $tell = $user_data['cli_tell'];
                $dt_nasc = $user_data['cli_dat_nasc'];
                $sexo = $user_data['cli_sexo'];
                $senha = $user_data['cli_senha'];
                $situacao = $user_data['cli_situacao'];
            }
            
        }
        else
        {   //CASO HAJA ERRO VOLTA PARA A TABELA DE CLIENTES
            header('Location: ../tclientes.php');
        }
    }
    else
    {       //CASO HAJA ERRO VOLTA PARA A TABELA DE CLIENTES
        header('Location: ../tclientes.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="box">
        <form action="saveEdit.php" method="POST">
            <fieldset>
                <legend><b>Editar Cliente</b></legend>
                <br><br>
                <div class="inputBox">
                    <input class="inputUser" type="text" id="cpf" name="cpf"  value="<?php echo $cpf ?>" required>
                    <label class="labelInput" for="cpf" >digite cpf: </label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input class="inputUser" type="text" id="nome" name="nome"  value="<?php echo $nome ?>" required>
                    <label class="labelInput" for="nome">digite o nome: </label>                    
                </div>
                <br><br>
                <div class="inputBox">           
                    <input class="inputUser" type="text" id="senha" name="senha" required maxlength="20" value="<?php echo $senha ?>" required>
                    <label class="labelInput" for="senha" > Digite uma senha: </label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input class="inputUser" type="text" id="tell" name="tell"  value="<?php echo $tell ?>" required>
                    <label class="labelInput" for="tell" >digite um telefone: </label>
                </div>
                <br><br>
                <div class="inputBox">
                    <label for="dt_nasc" > Digite Data de Nascimento: </label>
                    <input type="text" id="dt_nasc" name="dt_nasc"  value="<?php echo $dt_nasc ?>" required>                    
                </div>
                <br><br>
                    <label> <h4>marque seu sexo</h4></label>
                    <input type="radio" id="sexo" name="sexo" value="f" <?php echo $sexo == 'f' ? 'checked' : '' ?> required>                
                    <label for="f">Feminino</label>
                <br><br>
                    <input type="radio" id="sexo" name="sexo" value="m" <?php echo $sexo == 'm' ? 'checked' : '' ?> required>
                    <label for="m">Masculino</label>                
                <br><br>
                <label> <h4>ativar/blockear</h4></label>
                    <input type="radio" id="situcao" name="situacao" value="atv" <?php echo $situacao == 'atv' ? 'checked' : '' ?> required>                
                    <label for="atv">ativar</label>
                <br><br>                
                    <input type="radio" id="situcao" name="situacao" value="blk" <?php echo $situacao == 'blk' ? 'checked' : '' ?> required>                
                    <label for="blk">blockear</label>
                <br><br>                
                    <input type="hidden" name="cpf" value=<?php echo $cpf?>>
                    <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>