<?php
// Termo de busca
$query = 'gabinete dell';

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
        echo "<div style='display: flex; flex-wrap: wrap;'>";
        foreach ($data['results'] as $product) {
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px; width: 200px;'>";
            echo "<h3>" . $product['title'] . "</h3>";
            echo "<img src='" . $product['thumbnail'] . "' alt='" . $product['title'] . "' style='width: 100%;'>";
            echo "<p>Preço: R$ " . number_format($product['price'], 2, ',', '.') . "</p>";
            echo "<a href='" . $product['permalink'] . "' target='_blank' style='color: blue;'>Ver no Mercado Livre</a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "Nenhum produto encontrado.";
    }
}
