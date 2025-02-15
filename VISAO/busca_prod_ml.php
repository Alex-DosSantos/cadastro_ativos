<?php
include('../controle/controle_session.php');
include('cabecalho.php');
include('../controle/funcoes.php');
include('../modelo/conexao.php');
include('menu_superior.php');

$sql = "
    SELECT
    quantidadeAtivo,
    quantidadeMinAtivo,
    descricaoAtivo,
    (SELECT quantidadeUso FROM movimentacao m WHERE m.idAtivo = a.idAtivo and m.statusMov='S') as quantidade_uso,
    (SELECT descicaoMarca FROM marca ma WHERE ma.idMarca = a.idMarca ) as descr_marca
    FROM ativos a
    ";
$result = mysqli_query($conexao, $sql) or die(false);
$ativos = $result->fetch_all($result, MYSQLI_ASSOC);
$resultado = "";
   foreach ($ativos as $ativo){
    $quantidade_disponivel = $ativo['quantidadeAtivo']- $ativo['quantidadeMinAtivo'];
    if ($quantidade_disponivel < $ativo['quantidadeMinAtivo']){
        echo $termo_busca = $ativo['descricaoAtivo'].$ativo['descr_marca'];
        $resultado.= busca_prod_ml($termo_busca);
    }
   } 
?>

