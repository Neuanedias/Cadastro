<?php
    include 'conexao.php';
    // echo "<pre>";
    // print_r($_SERVER);
    // echo "</pre>";
    // exit;
     if($_SERVER['REQUEST_METHOD'] == "POST"){
        //capturar os dados digitando no form e salva em variaveis
        //para facilitar a manipulação dos dados
       
        $descricao = $_POST['descricao'];
        $data_do_vale = $_POST['data_do_vale'];
        $valor = $_POST['valor'];
        
        //vamos abrir a conexão com o banco de dados
        $conexaoComBanco = abrirBanco();

      //vamos criar o SQL para realizar o insert dos dados no BD
      $sql ="INSERT INTO vales ( descricao, data_do_vale, valor)
       VALUES ('$valor', '$descricao', '$data_do_vale',)";

    if($conexaoComBanco->query($sql)=== TRUE){
        echo ":) Sucesso ao cadastrar o contato :)";
     } else{
            echo ":Erro ao cadastrar o contato :(";

    }

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
    <header class="menu-header">
     
    <nav class="nav-menu">
        <ul>
            <li><a href="index.php">home</a></li>
            <li><a href="cadastrar.php">cadastrar</a></li>
        </ul>
    </nav>
  </header>
  <!-- <h1 class="titulo1">Gerenciar vales</h1> -->
  <br>
  <h2 class="titulo2">Cadastrar vale</h2>
  <section class="menu-section">

    <div class="tabela-cadastro">
    <form  action="" method="post" enctype="multpart/form-data"> 

       

        <label for="descricao">descricao</label>
        <input type="text" id="descricao" name="descricao" required>

        <label for="valor">valor</label>
        <input type="valor" id="valor" name="valor" required>

        <label for="data_do_vale">data_do_vale</label>
        <input type="date" id="data_do_vale" name="data_do_vale" required>

        <button class="btn-card" type="submit">Cadastrar</button> 
        </div>
    </form>
  </section>
 
</body>

</html>


<?php
//incluir a conexao na pagina e todo o seu conteudo
include 'conexao.php';
include_once 'funcoes.php';

if(isset($_GET['acao']) && $_GET['acao'] == 'excluir'){

    $id = $_GET['id'];

    if($id > 0){
     //abrir a conexao com o banco
     $conexaoComBanco =abrirBanco();
     //preparar um SQL de Exclusão
     $sql = "DELETE FROM vales WHERE id = $id";
     //executar comando no banco
     if($conexaoComBanco->query($sql)===TRUE){
        echo "<script>alert('contato excluido com sucesso!')</script>";
     }else{
        echo "contato excluido com sucesso! :(";
     }

    }
    fecharBanco($conexaoComBanco);
}
?>