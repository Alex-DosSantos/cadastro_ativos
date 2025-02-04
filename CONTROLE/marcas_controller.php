<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);
include('../modelo/conexao.php');
include('controle_session.php');

$marca = $_POST['marca'];
$user = $_SESSION['id_user'];
$acao = $_POST['acao'];
$idMarca = $_POST['idMarca'];
$statusMarca = $_POST['status'];
if ($acao == 'inserir'){
    $query = "
    insert into marca (
    descricaoMarca,
    statusMarca,
    dataCadastro,
    usuarioCadastro
    ) values (
    '".$marca."',
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
    UPDATE marca
    SET statusMarca = '$statusMarca'
     WHERE
      idMarca = $idMarca
    ";
    $result = mysqli_query($conexao, $sql) or die (false);
if ($result){
    echo "status alterado";

}
}

if($acao== 'get_info'){
    $sql = "
    SELECT
        descricaoMArca
    FROM 
        marca
    WHERE
     idMarca = $idMarca
    ";

$result = mysqli_query($conexao, $sql) or die(false);
$marca  = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($marca);
exit();
}

if($acao== 'update'){
    $sql = "
    UPDATE marca set
    descricaoMarca='$marca'
     WHERE
      idMarca = $idMarca
    ";
    $result = mysqli_query($conexao, $sql) or die (false);
if ($result){
    echo "informações alteradas";

}
}


?>
