<?php 

include('conexao.php');



if(isset($_GET['id_departamento'])) {
  $id_departamento = $_GET['id_departamento'];
  
  $sql = $connect->prepare("SELECT * FROM DEPARTAMENTOS WHERE id_departamento = $id_departamento");
  $sql->execute();
  $r = $sql->fetchAll();
  
 
  $nome = $r[0]['nome'];
  $sigla = $r[0]['sigla'];
  $acao = 'editar';
  $input = 'Editar';
  $titulo = 'Editar';

} else {
  $titulo = 'Cadastrar';
  $nome = '';
  $sigla = '';
  $acao = 'inserir';
  $id_departamento = '';
  $input = 'SALVAR';
}


?>

<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.R.U.D - <?php echo($titulo); ?> Departamento</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    
  </head>
  <body>
  <?php include('menu.php') ?>
    <div class="container">
      <h1><?php echo($titulo); ?> Departamento</h1>
      <hr>
      <form action="acaodepartamentos.php" method="POST" onsubmit="return testInputs()">
      
      <div class="row">
        <div class="col-sm-6 col-md-6">
          <div class="form-group">  
            <input type="text" name="nome" id="nome" value="<?php echo($nome);?>" placeholder="NOME" maxlength="50" class="form-control">
          </div>
        </div>

        <div class="col-sm-3 col-md-4">
          <div class="form-group">
            <input type="text" name="sigla" value="<?php echo($sigla); ?>" id="sigla" placeholder="SIGLA" maxlength="14" class="form-control">
          </div>
        </div>

        <div class="col-sm-3 col-md-2">
          <div class="form-group">
            <button class="btn btn-primary" <?php if($id_departamento != '') {?> onclick="return confirm('Deseja alterar departamento: <?php echo($nome) ?>?') <?php }?>"type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> <?php echo(strtoupper($input))?></button>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="alert alert-danger hidden" id="err">TODOS OS CAMPOS DEVEM SER PREENCHIDOS!</div>
        </div>    
      </div>        
      
      <input type="hidden" name="acao" value="<?php echo($acao)?>">
      <input type="hidden" name="id_departamento" value="<?php echo($id_departamento)?>">

      </form>
      
      <a href="listar-departamentos.php" class="btn btn-success"><i class="glyphicon glyphicon-chevron-left"></i> VOLTAR</a>

    </div>
    <script src="./js/form.js"></script>
  </body>
</html>