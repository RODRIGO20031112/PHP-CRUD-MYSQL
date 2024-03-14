<?php
  session_start();

  include 'fundb.php'
?>

<!DOCTYPE html>
<html lang="pt-br">
 <head>
    <meta charset="UTF-8" />
    <title>Formulário de Dados</title>
 </head>
 <body>
    <form action="index.php" method="post" style="margin: 20px; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
      <label for="nome" style="display: block; margin-bottom: 10px;">Nome:</label>
      <input type="text" id="nome" name="nome" required style="margin-bottom: 10px; padding: 5px; width: 100%;" /><br />

      <label for="idade" style="display: block; margin-bottom: 10px;">Idade:</label>
      <input type="number" id="idade" name="idade" required style="margin-bottom: 10px; padding: 5px; width: 100%;" /><br />

      <label for="nacionalidade" style="display: block; margin-bottom: 10px;">Nacionalidade:</label>
      <input
        type="text"
        id="nacionalidade"
        name="nacionalidade"
        required
        style="margin-bottom: 10px; padding: 5px; width: 100%;"
      /><br />

      <input type="submit" name='action' value="Criar dados" style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;" />
    </form>

    <form action="index.php" method="get" style="margin: 20px; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
      <label for="id" style="display: block; margin-bottom: 10px;">Digite o ID que deseja procurar:</label>
      <input type="text" id="id" name="id" required style="margin-bottom: 10px; padding: 5px; width: 100%;" /><br />
      <input type="submit" value="Procurar" style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;" />
    </form>
   
    <?php
      include 'functions.php';

      if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == 'Criar dados') { 
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];
        $nacionalidade = $_POST['nacionalidade'];

        $_SESSION['dados'][] = criarDados($nome, $idade, $nacionalidade);
        relerTodosDados();        
      }

      if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $id = $_GET['id'];
        relerDadosFiltrados($id);
       
      }

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
        updateDados();
        relerTodosDados();
      }
      
      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action_delete']) && $_POST['action_delete'] == 'delete') {
        deletarDados();
        relerTodosDados();
      }
    ?>
 </body>
</html>