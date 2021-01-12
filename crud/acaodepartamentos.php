<?php
include('conexao.php');

# REQUEST modo generico de requisicao http
if (isset($_REQUEST['acao'])) {
   $acao = $_REQUEST['acao'];

   #a acao pode ser de 3 tipos inserir, editar ou excluir
   #é necessario testar as 3
   switch ($acao) {
      case 'inserir':
         if (isset($_POST['nome']) && isset($_POST['sigla'])) {
            $nome = $_POST['nome'];
            $sigla = strtoupper($_POST['sigla']);

            $sql = $connect->prepare("INSERT INTO DEPARTAMENTOS (nome, sigla) VALUES ('$nome', '$sigla')");
            $sql->execute();
         }
      break;

      case 'editar':
         if (isset($_POST['nome']) && isset($_POST['sigla']) && isset($_POST['id_departamento'])) {
            $nome = $_POST['nome']; 
            $sigla = strtoupper($_POST['sigla']);
            $id_departamento = $_POST['id_departamento'];
         
            $sql = $connect->prepare("UPDATE DEPARTAMENTOS SET nome = '$nome', sigla = '$sigla' 
            WHERE id_departamento = $id_departamento");
            $sql->execute();
         }
      break;

      case 'excluir':
         if (isset($_GET['id_departamento'])) {
            $id_departamento = $_GET['id_departamento'];
            
            try {
               $sql = $connect->prepare("DELETE FROM DEPARTAMENTOS WHERE id_departamento = $id_departamento");
               $sql->execute();
            } catch (Exception $e) {
               header('location: listar-departamentos.php?msg=erro');
               exit;
            }
         }
      break;
   }
   header('location: listar-departamentos.php');
}


?>