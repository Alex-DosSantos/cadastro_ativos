<?php


include('../modelo/conexao.php');
include('controle_session.php');
ini_set('display_errors', 1);
error_reporting(E_ERROR);

$Ativo = $_POST['idAtivo'];
$descricaoMovimentacao = $_POST['descricaoMovimentacao'];
$quantidadeMov = $_POST['quantidadeMov'];
$tipoMovimentacao = $_POST['tipoMovimentacao'];
$localOrigem = $_POST['localOrigem'];
$localDestino = $_POST['localDestino'];
$user = $_SESSION['id_user']; // Usuário logado


$sqlTotal = "
        SELECT
          quantidadeAtivo
        FROM 
          ativos
        WHERE
         idAtivo = $Ativo

";

$resultTotal = mysqli_query($conexao, $sqlTotal) or die(false);
$ativoTotal = $resultTotal->fetch_assoc();

$quantidadeTotal = $ativoTotal['quantidadeAtivo'];


$sqlUso = "
      SELECT
          COALESCE(quantidadeUso,0) as quantidadeUso
      FROM
          movimentacao
      WHERE 
       idAtivo = $Ativo 
       AND  statusMov = 'S'
";
$resultUso = mysqli_query($conexao, $sqlUso) or die(false);
$ativosUso = $resultUso->fetch_assoc();
$quantidadeUso = $ativosUso['quantidadeUso'];

if ($tipoMovimentacao == 'entrada') {
  $soma_quantidade = $quantidadeUso + $quantidadeMov;
  if ($quantidadeTotal < $soma_quantidade) {
    echo "Quantidade indisponivel para realizar movimentação quantide de ativos em uso mais a quantidade de ativos selecionados ultrapassa o total de ativos cadastrados";
    exit();
  }
} else if ($tipoMovimentacao == 'saida') {
  if ($quantidadeUso - $quantidadeMov < 0) {
    echo "Quantidade insuficiente para realizar a movimentação quantidade de ativos que serão removidos é maior que a quantitade de uso! ";
    exit();
  }
  $soma_quantidade = $quantidadeUso - $quantidadeMov;
} else {
  if ($quantidadeUso - $quantidadeMov < 0) {
    echo "Quantidade insuficiente para realizar a movimentação quantidade de ativos que serão realocados é maior que a quantidade de uso! ";
    exit();
  }
  $soma_quantidade = $quantidadeUso;
}

$queryUpdate = "update movimentacao
                set statusMov = 'N'
                WHERE idAtivo = $Ativo
                ";
$result = mysqli_query($conexao, $queryUpdate) or die(false);

$query = "
INSERT INTO movimentacao(
 idAtivo,
  descricaoMovimentacao,
   quantidadeMov,
   quantidadeUso,
    tipoMovimentacao,
     localOrigem,
      localDestino,
       statusMov,
       dataMovimentacao,
        idUsuario
        )VALUES (
        '" . $Ativo . "',
         '" . $descricaoMovimentacao . "',
          '" . $quantidadeMov . "',
          '" . $soma_quantidade . "',
           '" . $tipoMovimentacao . "',
            '" . $localOrigem . "',
             '" . $localDestino . "',
              'S',
              NOW(),
               '" . $user . "'
)";

$result = mysqli_query($conexao, $query) or die(false);
if ($result) {
  echo "sucesso";
} else {
  echo "erro";
}
