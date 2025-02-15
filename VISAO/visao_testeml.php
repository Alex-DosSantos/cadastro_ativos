<?php
include('../controle/controle_session.php');
include('cabecalho.php');
include('../controle/funcoes.php');
include('../modelo/conexao.php');
include('menu_superior.php');

$query = 'gabinet';

// URL da API para buscar produtos
$url = "https://api.mercadolibre.com/sites/MLB/search?q=" . urlencode($query);

// Fazer a requisição
$response = file_get_contents($url);

// Verificar se a requisição foi bem-sucedida
if ($response === FALSE) {
    echo "Erro ao acessar a API do Mercado Livre.";
} else {
    // Decodificar a resposta JSON
    $data = json_decode($response, true);

    // Exibir os produtos
    if (isset($data['results'])) {
        echo "<div class='product-container'>";
        foreach ($data['results'] as $product) {
            echo "<div class='product-card'>";
            echo "<h3 class='product-title'>" . $product['title'] . "</h3>";
            echo "<img src='" . $product['thumbnail'] . "' alt='" . $product['title'] . "' class='product-image'>";
            echo "<p class='product-price'>Preço: R$ " . number_format($product['price'], 2, ',', '.') . "</p>";
            echo "<a href='" . $product['permalink'] . "' target='_blank' class='mercado-livre-button'>Ver no Mercado Livre</a>";
            echo "</div>";
        }
        echo "</div>";
    }else {
        echo "Nenhum produto encontrado.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repor Ativos</title>
    <!-- Inclusão de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link para o arquivo CSS -->
    <link rel="stylesheet" href="../css/stylesml.css"> <!-- Caminho para o seu arquivo CSS -->
</head>
<body>
</body>
</html>