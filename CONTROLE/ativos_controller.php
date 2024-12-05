<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);
include('../modelo/conexao.php');
include('controle_session.php');
$ativo = $_POST['ativo'];
$quantidade = $_POST['quantidade'];
$marca = $_POST['marca'];
$tipo = $_POST['tipo'];
$obs = $_POST['obs'];
$user = $_SESSION['id_user'];
$acao = $_POST['acao'];
$idAtivo = $_POST['idAtivo'];
$statusAtivo = $_POST['status'];
if ($acao == 'inserir'){
    $query = "
    insert into ativos (
    descricaoAtivo,
    quantidadeAtivo,
    statusAtivo,
    observacaoAtivo,
    idMarca,
    idTipo,
    dataCadastro,
    usuarioCadastro
    ) values (
    '".$ativo."',
    '".$quantidade."',
    'S',
    '".$obs."',
    '".$marca."',
    '".$tipo."',
 NOW(),
 '".$user."'
    )
";
$result = mysqli_query($conexao, $query) or die (false);
if ($result){
    echo "cadastro realizado";
}
}
if($acao=='alterar_status'){
$sql = "
    UPDATE ativos
    SET statusAtivo = '$statusAtivo'
     WHERE
      idAtivo = $idAtivo
    ";
    $result = mysqli_query($conexao, $sql) or die (false);
if ($result){
    echo "status alterado";

}
}

if($acao== 'get_info'){
    $sql = "
    SELECT
        descricaoAtivo,
        quantidadeAtivo,
        statusAtivo,
        observacaoAtivo,
        idMarca,
        idTipo
    FROM 
        ativos
    WHERE
     idAtivo = $idAtivo
    ";

$result = mysqli_query($conexao, $sql) or die(false);
$ativo  = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($ativo);
exit();
}

if($acao== 'update'){
    $sql = "
    UPDATE ativos set
    descricaoAtivo='$ativo',
    idMarca='$marca',
    idTipo='$tipo',
    quantidadeAtivo='$quantidade',
    observacaoAtivo='$obs'
     WHERE
      idAtivo = $idAtivo
    ";
    $result = mysqli_query($conexao, $sql) or die (false);
if ($result){
    echo "informações alteradas";

}
}


?>
