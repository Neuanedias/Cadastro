
<?php

// Criar constantes para armazebar as informaçoes de acesso ao banco.
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "cadastro");
define("DB_PORT", 3306);

/**
 * Abre uma conexao com uo banco de dados e retorna um objeto de conexao.
 * @return mysqli que é um objeto de conexao mysql.
 */

function abrirBanco(){
    $conexaoComBanco = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    // verificar se ocorreu algum erro durante a conexao.
    if($conexaoComBanco->connect_error){
       die("falha na conexão:" . $conexaoComBanco->connect_error);
    }
    return $conexaoComBanco;
}
/**
 * Fechar a conexão com o banco de dados
*/
function fecharBanco($conexaoComBanco){
    $conexaoComBanco->close();
}

?>