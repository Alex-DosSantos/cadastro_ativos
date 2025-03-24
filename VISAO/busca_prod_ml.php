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

$sql = "
    SELECT
    quantidadeAtivo,
    quantidadeMinAtivo,
    descricaoAtivo,
    (SELECT quantidadeUso FROM movimentacao m WHERE m.idAtivo = a.idAtivo and m.statusMov='S') as quantidade_uso,
    (SELECT descricaoMarca FROM marca ma WHERE ma.idMarca = a.idMarca ) as descr_marca
    FROM ativos a
    ";
    if (isset($_GET['idAtivo'])) {
        $sql .= ' WHERE a.idAtivo ='.$_GET['idAtivo'].'';
    }
    
$result = mysqli_query($conexao, $sql) or die(false);
$ativos = $result->fetch_all(MYSQLI_ASSOC);
$resultado = "";

   foreach ($ativos as $ativo){
    $quantidade_disponivel = $ativo['quantidadeAtivo']- $ativo['quantidadeMinAtivo'];
    if ($quantidade_disponivel < $ativo['quantidadeMinAtivo'] && !isset($_GET['idAtivo'])){

        $termo_busca = $ativo['descricaoAtivo'].' '.$ativo['descr_marca'];
        $resultado.= busca_prod_ml($termo_busca);
    }
    if (isset($_GET['idAtivo'])) {
        $termo_busca = $ativo['descricaoAtivo'].' '.$ativo['descr_marca'];
        $resultado.= busca_prod_ml($termo_busca);
    }
   } 
   echo $resultado;


   
?>

