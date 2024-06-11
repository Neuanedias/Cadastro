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
  
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro</title>
    <link rel="stylesheet" href="css/index.css">

</head>
<body>
    <header class="menu-header">
 
    <nav class="menu-nav">
        <ul>
            <li><a href="index.php">home</a></li>
            <li><a href="cadastrar.php">cadastrar</a></li>
        </ul>   
    </nav>
  </header>
  <h1 class="titulo-p">Gerenciar vales</h1>  
  <section>
    <br>
    <h2 class="titulo-s">Cadastrar vale</h2> 

    <table border ="1" class="table-listar">
        <thead>
            <tr>
                <td>Data de cadastro</td>
                <td>Data do vale</td>
                <td>Descricao</td>
                <td>Valor</td>
                <td>Atualizado</td>
                <td>Acoes</td>
            

            </tr>
        </thead>
        <tbody>
        <?php

        //Abrir a conexão com o banco de dados
        $conexaoComBanco = abrirBanco();
        //Preparar a consulta SQL para selecionar os dados no BD
        $query = "SELECT descricao, valor, data_do_vale, atualizado_em, criado_em, 
                FROM vales";
        //Executar a query (o sql no banco)
        $result = $conexaoComBanco->query($query);
        //echo "<pre>";
        //print_r($_SERVER);
        //echo "</pre>";
        //exit;
        //$registros = $result->fetch_assoc();
        //Verificar a query retornou registros
         if($result->num_rows > 0){
        //tem registro no banco
        while($registros = $result->fetch_assoc()){
            ?>
             <tr>
            <td><?= date("d/m/Y", strtotime($registros['criado_em']))?></td>
            <td><?= date("d/m/Y", strtotime($registros['data_do_vale']))?></td>
            <td><?= $registros['descricao']?></td>
            <td><?= $registros['valor']?></td>
            <td><?= date("d/m/Y", strtotime($registros['atualizado_em']))?></td>


                    <a href="editar.php?acao=editar&id=<?= $registros['id']?>"><button class="btn-editar">Editar</button></a>
                    <a href="?acao=excluir&id=<?= $registros['id']?>"onclick="return confirm('tem certeza que deseja excluir?');">
                    <button class="btn-excluir">Excluir</button></a>
                </td>  
             </tr>
            <?php
        }


         }else{
        ?>
       
        <tr>
            <td colspan='7'>Nenhum Registro encontrado no banco de dados</td>
           </tr>
        <?php
         }
        //Criar um laço de repetição para preencher a tabela
        

        ?>
        </tbody>
    </table>
  </section>
</body>
</html>