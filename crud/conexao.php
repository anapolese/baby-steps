<?php
$username = 'root';
$password = '';

try {

   $connect = new PDO('mysql:host=localhost;dbname=empresa', $username, $password);
   $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}  catch(PDOException $e) {
   
   echo('Erro: '. $e->getMessage());
}

?>