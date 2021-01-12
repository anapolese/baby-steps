<?php 

include('conexao.php');

# agora executamos a query no banco
$sql = $connect->prepare('SELECT * FROM DEPARTAMENTOS ORDER BY NOME');
$sql->execute();
$result = $sql->fetchAll(); #converte a um vetor associativo legivel ao php

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C.R.U.D - Listar Departamentos</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
<?php include('menu.php'); ?>
  <div class="container">
    <h1>Departamentos</h1>
    <?php 
    if (isset($_GET['msg'])) { 
    ?>
      <div class="alert alert-danger">
      <i class="glyphicon glyphicon-ban-circle"></i> Existem cadastros nesse item.</div>
   <?php } ?>

    <hr>
      <a href="form-departamentos.php" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> NOVO</a>
    <br>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Sigla</th>
          <th class="text-right">Ação</th>
        </tr>
      </thead>
      <tbody>

      <?php
        #agora fazemos uma repetiço para percorrer nosso vetor
        foreach ($result as $r) {
      ?>

        <tr>
          <td><?php echo ($r['nome']); ?> </td>
          <td><?php echo ($r['sigla']); ?></td>
          <td class="text-right">
            <a href="form-departamentos.php?id_departamento=<?php echo($r['id_departamento']) ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
            <a onclick="return confirm('Deseja excluir o departamento: <?php echo($r['nome'])?>?')" href="acaodepartamentos.php?acao=excluir&id_departamento=<?php echo($r['id_departamento']); ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
          </td>
        </tr>

      <?php } ?>

        
      </tbody>
    </table>
    
    <a href="index.php" class="btn btn-success"><i class="glyphicon glyphicon-chevron-left"></i> VOLTAR</a>

  </div>
</body>
</html>