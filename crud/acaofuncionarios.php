<?php
include('conexao.php');

# REQUEST modo generico de requisicao http
if (isset($_REQUEST['acao'])) {
   $acao = $_REQUEST['acao'];

   #a acao pode ser de 3 tipos inserir, editar ou excluir
   #é necessario testar as 3
   switch ($acao) {
      case 'inserir':
         if (isset($_POST['funcionario']) && isset($_POST['nascimento']) && isset($_POST['admissao']) && isset($_POST['genero']) && isset($_POST['salario']) && isset($_POST['departamento'])) {
            $nome = ucwords(strtolower(trim($_POST['funcionario'])));
            $dt_nascimento = $_POST['nascimento'];
            $dt_admissao = $_POST['admissao'];
            $genero = $_POST['genero'];
            $salario = str_replace(',', '.', str_replace('.', '', $_POST['salario']));
            $id_departamento = $_POST['departamento'];

            $sql = $connect->prepare("INSERT INTO FUNCIONARIOS (nome, dt_nascimento, dt_admissao, genero, salario, id_departamento) VALUES ('$nome', '$dt_nascimento', '$dt_admissao', '$genero', '$salario', '$id_departamento')");
            $sql->execute();
         }
      break;

      case 'editar':
         if (isset($_POST['funcionario']) && isset($_POST['nascimento']) && isset($_POST['admissao']) && isset($_POST['genero']) && isset($_POST['salario']) && isset($_POST['departamento']) && isset($_POST['id_funcionario'])) {
            $nome = ucwords(strtolower(trim($_POST['funcionario'])));
            $dt_nascimento = $_POST['nascimento'];
            $dt_admissao = $_POST['admissao'];
            $genero = $_POST['genero'];
            $salario = str_replace(',', '.', str_replace('.', '', $_POST['salario']));
            $id_departamento = $_POST['departamento'];
            $id_funcionario = $_POST['id_funcionario'];
         
            $sql = $connect->prepare("UPDATE FUNCIONARIOS SET nome = '$nome', dt_nascimento = '$dt_nascimento', dt_admissao = '$dt_admissao', genero = '$genero', salario = '$salario', id_departamento = '$id_departamento'
            WHERE id_funcionario = $id_funcionario");
            $sql->execute();
         }
      break;

      case 'excluir':
         if (isset($_GET['id_funcionario'])) {
            $id_funcionario = $_GET['id_funcionario'];
            
            try {
               $sql = $connect->prepare("DELETE FROM FUNCIONARIOS WHERE id_funcionario = $id_funcionario");
               $sql->execute();
            } catch (Exception $e) {
               header('location: listar-funcionarios.php?msg=erro');
               exit;
            }
         }
      break;
   }
   header('location: listar-funcionarios.php');
}


?>
