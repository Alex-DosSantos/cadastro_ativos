<?php
function buscar_info_bd($conexao, $tabela, $coluna_were = false, $valor_where = false) {
    $sql = "select * from ". $tabela;
    if ($coluna_were != false) {
       $sql .= " where  $coluna_were ='".$valor_where."' ";
    }
    
    $result = mysqli_query($conexao, $sql) or die (false);
$dados = mysqli_fetch_all($result, MYSQLI_ASSOC);

return $dados;
}






?>