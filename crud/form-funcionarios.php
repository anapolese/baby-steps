<?php 

include('conexao.php');


$sql2 = $connect->prepare('SELECT * FROM DEPARTAMENTOS ORDER BY NOME');
$sql2->execute();
$result2 = $sql2->fetchAll();


$sql = $connect->prepare('SELECT DISTINCT genero FROM FUNCIONARIOS ORDER BY NOME');
$sql->execute();
$gender = $sql->fetchAll();


global $deps;
$deps = array();
foreach ($result2 as $r2) {       
 $deps += array($r2['id_departamento'] => $r2['nome']);
};

$gens = array_column($gender, 'genero');      


if(isset($_GET['id_funcionario'])) {
  $id_funcionario = $_GET['id_funcionario'];

  $sql = $connect->prepare("SELECT * FROM FUNCIONARIOS WHERE id_funcionario = $id_funcionario");
  $sql->execute();
  $r = $sql->fetchAll();  
  
  $nome = $r[0]['nome'];
  $genero = $r[0]['genero'];
  $dt_nascimento = $r[0]['dt_nascimento'];
  $salario = $r[0]['salario'];
  $dt_admissao = substr($r[0]['dt_admissao'], 0, 10);
  $id_departamento = $r[0]['id_departamento'];
  $acao = 'editar';
  $input = 'Editar';
  $titulo = 'Editar';

} else {
  $titulo = 'Cadastrar';
  $nome = '';
  $genero = '';
  $dt_nascimento = '';
  $salario = '';
  $dt_admissao = '';
  $id_departamento = '';
  $id_funcionario = '';
  $acao = 'inserir';
  $input = 'SALVAR';
}

?>

<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.R.U.D - <?php echo($titulo); ?> Funcionário</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.5.1.min.js" defer></script>
    <script type="text/javascript" src="./js/jquery.mask.min.js" defer></script>
  </head>
  <body>


  <?php include('menu.php') ?>
    <div class="container">
    <script type="text/javascript" language="javascript">
      $(document).ready(function(){
        // $('#nascimento').mask('00/00/0000');
        $('#salario').mask('000000.00', {reverse: true});
        // $('#admissao').mask('00/00/0000 00:00:00');
      });

    </script>
      
      <h1><?php echo($titulo); ?> Funcionário</h1>
      <hr>
      <form action="acaofuncionarios.php" method="POST" onsubmit="return testInputs()">
      
      <div class="row">
        <div class="col-sm-9 col-md-10">
          <div class="form-group">
          <label for="funcionario">Nome</label> 
            <input type="text" name="funcionario" id="funcionario" value="<?php echo($nome);?>" placeholder="NOME" maxlength="50" class="form-control">
            </div>
        </div>

        <div class="col-sm-1 col-md-2">
          <div class="form-group">
            <label for="genero">Genero</label>
            <select  class="form-control" id="genero" name="genero">
               <option value="0">Genero...</option>
                  <?php 
                  foreach ($gens as $g) {
                     if ($g == $genero) {
                        $selecionado = 'selected';  
                     } else {
                        $selecionado = '';  
                     }
                  ?>
               <option value="<?php echo($g) ?>" <?php echo($selecionado) ?>><?php echo($g) ?></option>
                  <?php } ?>
            </select>
          </div>
        </div>

         <div class="col-sm-2 col-md-3">
            <div class="form-group">
               <label for="nascimento">Data de Nascimento</label>
               <input type="date" name="nascimento" value="<?php echo($dt_nascimento); ?>" id="nascimento" placeholder="DATA DE NASCIMENTO" class="form-control">
            </div>
         </div>
        
        <div class="col-sm-2 col-md-3">
        <div class="form-group">
          <label for="salario">Salário</label>
            <div class="input-group">
               <div class="input-group-addon">R$</div>
               <input type="text" name="salario" value="<?php echo($salario); ?>" id="salario" placeholder="SALARIO" maxlength="14" class="form-control">
               </div>
          </div>
        </div>

        <div class="col-sm-2 col-md-3">
          <div class="form-group">
            <label for="admissao">Data de Admissão</label>
            <input type="date" name="admissao" value="<?php echo($dt_admissao); ?>" id="admissao" placeholder="DATA DE ADMISSAO" maxlength="1" class="form-control">
          </div>
        </div>


        <div class="col-sm-2 col-md-3">
          <div class="form-group">
            <label for="departamento">Departamento</label>  
            <select  class="form-control" id="departamento" name="departamento">
             <option value="0">Selecionar Departamento...</option>
         <?php

         for ($i = 1; $i <= count($deps); $i++) {
            if ($i == $id_departamento) {
               $selecionado = 'selected';
            } else {
               $selecionado = '';
            }
         ?>
             <option value="<?php echo ($i); ?>" <?php echo($selecionado) ?>><?php echo ($deps[$i]) ?></option> 
         <?php }; ?>
            </select>
          </div>
        </div>

      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger hidden" id="err">TODOS OS CAMPOS DEVEM SER PREENCHIDOS!</div>
        </div>    
      </div>        
         <input type="hidden" name="acao" value="<?php echo($acao)?>">
         <input type="hidden" name="id_funcionario" value="<?php echo($id_funcionario)?>">

      </form>

      <br>

      <div class="container">
         <a href="listar-funcionarios.php" class="btn btn-success"><i class="glyphicon glyphicon-chevron-left"></i> VOLTAR</a>
         <button class="btn btn-primary" <?php if($id_funcionario != '') {?> onclick="return confirm('Deseja alterar funcionário: <?php echo($nome) ?>?') <?php }?>"type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> <?php echo(strtoupper($input))?></button>     
      </div>      
    </div>
    
    
  <script type="text/javascript" src="./js/formfunc.js"></script>
 

  </body>

</html>