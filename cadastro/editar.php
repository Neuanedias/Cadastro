<?php
include 'conexao.php';
include_once 'funcoes.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {

    //if ternário
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    //vamos abrir a conexão com banco de dados
    $conexaoComBanco = abrirBanco();




    $sql = "select * FROM vales WHERE id = ?";
    //preparar o sql para consultar o id no banco de dados
    $pegarDados = $conexaoComBanco->prepare($sql);
    //substituir o ????
    $pegarDados->bind_param("i", $id);
    $pegarDados->execute();
    $result = $pegarDados->get_result();


    if ($result->num_rows == 1) {
        $registro = $result->fetch_assoc();
    } else {
        echo "Nenhum registro encontrado";
        exit;
    }

    $pegarDados->close();
    fecharBanco($conexaoComBanco);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //dd($_POST);
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $data_de_cadastro = $_POST['data_de_cadastro'];
    $data_do_vale = $_POST['data_do_vale'];
    $atualizado_em = $_POST['atualizado_em'];
    $criado_em = $_POST['criado_em'];

    $conexaoComBanco = abrirBanco();

    $sql = "UPDATE vales SET id = '$id', descricao = '$descricao',
     valor = '$valor', data_do_vale = '$data_do_vale', atualizado_em = '$atualizado_em', criado_em = '$criado_em', data_de_cadastro = '$data_de_cadastro'
     WHERE id = $id";
    
    if($conexaoComBanco->query($sql)=== TRUE){
        echo ":) Sucesso ao Atualizar o contato :)";
     } else{
            echo ":Erro ao Atualizar o contato :(";
     }
    fecharBanco($conexaoComBanco);
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro</title>
    <link rel="stylesheet" href="css/cadastrar.css">

</head>

<body>
    <header>
        <h1>Gerenciar vales</h1>
        <nav>
            <ul>
                <li><a href="index.php">home</a></li>
                <li><a href="cadastrar.php">cadastrar</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>Cadastrar vales</h2>
        <form action="" method="post" enctype="multpart/form-data">

            <label for="id">id</label>
            <input type="text" id="id" name="id" value="<?= $registro['id'] ?>" required>

            <label for="descricao">descricao</label>
            <input type="text" id="descricao" name="descricao" value="<?= $registro['descricao'] ?>" required>

            <label for="valor">valor</label>
            <input type="text" id="valor" name="valor" value="<?= $registro['valor'] ?>" required>

            <label for="data_de_cadastro">data_de_cadastro</label>
            <input type="date" id="data_de_cadastro" name="data_de_cadastro" required>

            <label for="data_do_vale">data_do_vale</label>
            <input type="date" id="data_do_vale" name="data_do_vale" value="<?= $registro['data_do_vale'] ?>" required>

            <label for="atualizado_em">atualizado_em</label>
            <input type="text" id="atualizado_em" name="atualizado_em" value="<?= $registro['atualizado_em'] ?>" required>

            <label for="criado_em">criado_em</label>
            <input type="text" id="criado_em" name="criado_em" value="<?= $registro['criado_em'] ?>" required>

            <input type="hidden" id="id" name="id" value="<?= $registro['id'] ?>">

            <button type="submit">Atualizar</button>
        </form>
    </section>

</body>

</html>