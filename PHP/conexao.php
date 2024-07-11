<?php

    //FAX CONEXÃO COM O BANCO DE DADOS
    
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tcc_barbearia";

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
            
?>