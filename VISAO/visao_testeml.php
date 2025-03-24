<?php
include('../controle/controle_session.php');
include('cabecalho.php');
include('../controle/funcoes.php');
include('../modelo/conexao.php');
include('menu_superior.php');





// Recuperar os ativos e quantidades mínimas do banco de dados
function recuperar_ativos($conexao) {
    $query = "
    SELECT
    quantidadeAtivo,
    quantidadeMinAtivo,
    descricaoAtivo,
    (SELECT quantidadeUso FROM movimentacao m WHERE m.idAtivo = a.idAtivo and m.statusMov='S') as quantidade_uso,
    (SELECT descicaoMarca FROM marca ma WHERE ma.idMarca = a.idMarca ) as descr_marca
    FROM ativos a
    "; 
    $resultado = mysqli_query($conexao, $query);

    $ativos = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $ativos[] = $row;
    }

    return $ativos;
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