<?php
include_once ('controle_session.php');
function buscar_info_bd($conexao, $tabela, $coluna_were = false, $valor_where = false) {
    $sql = "select * from ". $tabela;
    if ($coluna_were != false) {
       $sql .= " where  $coluna_were ='".$valor_where."' ";
    }
    
    $result = mysqli_query($conexao, $sql) or die (false);
$dados = mysqli_fetch_all($result, MYSQLI_ASSOC);

return $dados;
}


function busca_prod_ml($query) {
    $accessToken="APP_USR-6865694427463087-031118-3324cf8347f20dec22b1788f19348f96-2320610094";
    $ch =curl_init();

    // URL da API para buscar produtos
    $url = "https://api.mercadolibre.com/sites/MLB/search?q=" . urlencode($query) .'&condition=new&status=active&sort=best_seller&limit=20';

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
"Authorization: Bearer $accessToken",
"Accept: application/json",
]);
$output = curl_exec($ch);

    // Fazer a requisição
   
    curl_close($ch);


    
        // Decodificar a resposta JSON
        $data = json_decode($output, true);
        $conteudo = '';

        // Exibir os produtos
        if (isset($data['results'])) {
            $conteudo.= "<div class='product-container'>";
            foreach ($data['results'] as $product) {
                $conteudo.= "<div class='product-card'>";
                $conteudo.= "<h3 class='product-title'>" . $product['title'] . "</h3>";
                $conteudo.= "<img src='" . $product['thumbnail'] . "' alt='" . $product['title'] . "' class='product-image'>";
                $conteudo.= "<p class='product-price'>Preço: R$ " . number_format($product['price'], 2, ',', '.') . "</p>";
                $conteudo.= "<a href='" . $product['permalink'] . "' target='_blank' class='mercado-livre-button'>Ver no Mercado Livre</a>";
                $conteudo.= "</div>";
            }
            $conteudo.= "</div>";
        } else {
            $conteudo.= "Nenhum produto encontrado.";
        }
    
    return $conteudo;
}





?>