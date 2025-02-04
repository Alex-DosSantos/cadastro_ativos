<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);
include('../modelo/conexao.php');
include('controle_session.php');

$tipo = $_POST['tipo'];
$user = $_SESSION['id_user'];
$acao = $_POST['acao'];
$idTipo = $_POST['idTipo'];
$statusTipo = $_POST['status'];
if ($acao == 'inserir'){
    $query = "
    insert into tipo (
    descricaoTipo,
    statusTipo,
    dataCadastro,
    usuarioCadastro
    ) values (
    '".$tipo."',
    'S',
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
    UPDATE tipo
    SET statusTipo = '$statusTipo'
     WHERE
      idTipo = $idTipo
    ";
    $result = mysqli_query($conexao, $sql) or die (false);
if ($result){
    echo "status alterado";

}
}

if($acao== 'get_info'){
    $sql = "
    SELECT
        descricaoTipo
    FROM 
        tipo
    WHERE
     idTipo = $idTipo
    ";

$result = mysqli_query($conexao, $sql) or die(false);
$tipo  = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($tipo);
exit();
}

if($acao== 'update'){
    $sql = "
    UPDATE tipo set
    descricaoTipo='$tipo'
     WHERE
      idTipo = $idTipo
    ";
    $result = mysqli_query($conexao, $sql) or die (false);
if ($result){
    echo "informações alteradas";

}
}


?>
