<?php 
    function getConectDb(){
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="plantas";

        try{
            $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully"; 
            return $conexao;
        }

       
    }
?>