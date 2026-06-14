<?php 
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="dbPlanta";

        try{
            $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }
        catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }

       

?>