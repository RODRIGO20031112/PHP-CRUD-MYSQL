<?php
include 'db.php';

function criarDados($nome, $idade, $nacionalidade) {
    global $conn;

    $sql = "INSERT INTO usuarios (nome, idade, nacionalidade) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) { return false; }

    mysqli_stmt_bind_param($stmt, "sis", $nome, $idade, $nacionalidade);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado === false) { return false; }

    mysqli_stmt_close($stmt);
}

function relerTodosDados() {
    global $conn;

    $sql = "SELECT * FROM usuarios";

    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        echo "Erro ao executar a consulta: " . mysqli_error($conn);
        return;
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo 
                "<form action='index.php' method='post' style='margin: 20px; padding: 20px; border: 1px solid #ccc; border-radius: 5px;'>",
                "ID: <input type='text' name='id' value='", $row['id'], "' readonly><br>",
                "Nome: <input type='text' name='nome' value='", $row['nome'], "'><br>", 
                "Idade: <input type='text' name='idade' value='", $row['idade'], "'><br>",
                "Nacionalidade: <input type='text' name='nacionalidade' value='", $row['nacionalidade'], "'><br>",
                "<input type='submit' name='action' value='update' style='padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;'>",
                "<input type='submit' name='action_delete' value='delete' style='padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;'>",
                "</form>";
        }
    } else {
        echo "Nenhum registro encontrado.";
    }

    mysqli_free_result($result);
}

function relerDadosFiltrados($id) {
    global $conn;

    $sql = "SELECT * FROM usuarios WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo "Erro ao preparar a declaração: " . mysqli_error($conn);
        return;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);

    $result = mysqli_stmt_execute($stmt);

    if ($result === false) {
        echo "Erro ao executar a declaração: " . mysqli_error($conn);
        return;
    }

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo 
            "<form action='index.php' method='post' style='margin: 20px; padding: 20px; border: 1px solid #ccc; border-radius: 5px;'>",
            "ID: <input type='text' name='id' value='", $row['id'], "' readonly><br>",
            "Nome: <input type='text' name='nome' value='", $row['nome'], "'><br>", 
            "Idade: <input type='text' name='idade' value='", $row['idade'], "'><br>",
            "Nacionalidade: <input type='text' name='nacionalidade' value='", $row['nacionalidade'], "'><br>",
            "<input type='submit' name='action' value='update' style='padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;'>",
            "<input type='submit' name='action_delete' value='delete' style='padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;'>",
            "</form>";
    } else {
        echo "Nenhum registro encontrado com o ID especificado.";
    }

    mysqli_stmt_close($stmt);
}

function updateDados() {
    global $conn;

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $nacionalidade = $_POST['nacionalidade'];

    $sql = "UPDATE usuarios SET nome=?, idade=?, nacionalidade=? WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo "Erro ao preparar a declaração: " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sisi", $nome, $idade, $nacionalidade, $id);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado === false) {
        echo "Erro ao executar a declaração: " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_close($stmt);

    return true;
}

function deletarDados() {
    global $conn;

    if (!isset($_POST['id'])) {
        echo "ID não fornecido.";
        return false;
    }

    $id = $_POST['id'];

    $sql = "DELETE FROM usuarios WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo "Erro ao preparar a declaração: " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado === false) {
        echo "Erro ao executar a declaração: " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_close($stmt);

    return true;
}
?>
