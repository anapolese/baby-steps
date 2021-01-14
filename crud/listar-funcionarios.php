<?php 

include('conexao.php');

$sql = $connect->prepare('SELECT 
                            F.nome as func_nome, 
                            F.genero as func_genero, 
                            DATE_FORMAT(F.dt_nascimento, "%d/%m/%Y") as func_dt_nascimento, 
                            DATE_FORMAT(F.dt_admissao, "%d/%m/%Y") as func_dt_admissao, 
                            FORMAT(F.salario, 2, "de_DE") as func_salario, 
                            F.id_departamento as func_id_departamento, 
                            F.id_funcionario as func_id_funcionario, 
                            D.nome as d_nome
                            FROM FUNCIONARIOS AS F
                            JOIN DEPARTAMENTOS AS D
                            ON D.id_departamento = F.id_departamento 
                            ORDER BY func_nome');
$sql->execute();
$result = $sql->fetchAll();


?>

<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C.R.U.D - Listar Funcionários</title>
  <script type="text/javascript" src="./js/jquery-3.5.1.min.js" defer></script>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
<?php include('menu.php'); ?>
   <div class="container">  
      
      <h1>Funcionários</h1>
         <?php 
            if (isset($_GET['msg'])) { 
         ?>
          <div class="alert alert-danger">
          <i class="glyphicon glyphicon-ban-circle"></i> Existem cadastros nesse item.</div>
         <?php } ?>
      
      <hr>
      <a href="form-funcionarios.php" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> NOVO</a>
      <br>

    <table class="table table-hover table-responsive">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Genero</th>
          <th>Data de Nascimento</th>
          <th>Salário</th>
          <th>Admissão</th>
          <th>Departamento</th>
          <th class="text-right">Ação</th>
        </tr>
      </thead>
      <tbody>
               
         <?php

         foreach ($result as $r) {
           
         ?>

        <tr>
          <td><?php echo ($r['func_nome']); ?> </td>
          <td><?php echo ($r['func_genero']); ?></td>
          <td><?php echo ($r['func_dt_nascimento']); ?></td>
          <td><?php echo ('R$ '.$r['func_salario']); ?></td>
          <td><?php echo (substr($r['func_dt_admissao'], 0, 10)); ?></td>
          <td><?php echo ($r['d_nome']); ?></td>
          <td class="text-right">
            <a href="form-funcionarios.php?id_funcionario=<?php echo($r['func_id_funcionario']) ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
            <a onclick="return confirm('Deseja excluir o funcionário: <?php echo($r['func_nome'])?>?')" href="acaofuncionarios.php?acao=excluir&id_funcionario=<?php echo($r['func_id_funcionario']); ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
          </td>
        </tr>

      <?php }; ?>

        
      </tbody>
    </table>


      <a href="index.php" class="btn btn-success"><i class="glyphicon glyphicon-chevron-left"></i> VOLTAR</a>   
   </div>
</body>
</html>
