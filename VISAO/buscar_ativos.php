<?php
include('../controle/controle_session.php');
include('cabecalho.php');
include('../controle/funcoes.php');
include('../modelo/conexao.php');
include('menu_superior.php');
?>
<body style="background-color:#e2e0db;"></body>
<link rel="stylesheet" href="../css/stylesml.css">

<?php
// Verifica se os parâmetros de busca foram passados via GET
if (isset($_GET['descricao']) && isset($_GET['marca'])) {
    $descricao = $_GET['descricao'];
    $marca = $_GET['marca'];

    // Concatena a descrição e a marca para formar o termo de busca
    $termo_busca = $descricao . " " . $marca;

    // Realiza a busca no Mercado Livre
    $resultado = busca_prod_ml($termo_busca);

    // Exibe o resultado da busca
    echo $resultado;
} else {
    // Se não houver parâmetros de busca, exibe uma mensagem de erro
    echo "Parâmetros de busca não fornecidos.";
}
?>

<!-- Botão para voltar à página principal -->
<div class="text-center mt-4">
    <a href="ativos.php" class="btn btn-primary">Voltar</a>
</div>