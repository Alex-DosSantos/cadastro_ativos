<?php
// includes com o banco e o controle de sessao
include('../modelo/conexao.php');
include_once('../controle/controle_session.php'); 
$json_data = file_get_contents('php://input'); //recebe dados via JSON
$data = json_decode($json_data, true);
// optem os parametros JSON e  POST
$cargo = isset($_POST['cargo']) ? $_POST['cargo'] : $data['cargo'];
$acao = isset($_POST['acao']) ? $_POST['acao'] : $data['acao'];

$user = $_SESSION['id_user']; // id do user
if ($acao == 'gravar_acesso') { // consulta os acessos atuais para o cargo selecionado
    $sql = " SELECT
            idCargo,
            idOpcao,
            idAcesso,
            statusAcesso
        FROM acesso
        WHERE idCargo = '$cargo'

";
    $result = mysqli_query($conexao, $sql) or die(false);
    $acessos = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($data['acessos'] as $infoAcesso) {
        $array_acessos_selecionados[$infoAcesso['idOpcao']] = $infoAcesso['acessos'];
    }
    $sql = "";
    if (!empty($acessos)) {
        foreach ($acessos as $acesso_bd) {
            if (array_key_exists($acesso_bd['idOpcao'], $array_acessos_selecionados)) {
                $sql .= "update acesso set statusAcesso='" . $array_acessos_selecionados[$acesso_bd['idOpcao']] . "' where idAcesso='" . $acesso_bd['idAcesso'] . "'; ";
            } else {
                $sql .= "update acesso set statusAcesso = 'N' where idAcesso = '" . $acesso_bd['idAcesso'] . "'; ";
            }
            unset($array_acessos_selecionados[$acesso_bd['idOpcao']]);
        }
    } 
    foreach ($array_acessos_selecionados as $idOpcao => $acesso_new) { // insere acessos que n tinham antes
        $sql .= " insert into acesso(
 idOpcao,
idCargo,
statusAcesso,
idUsuario,
dataCadastro
) values(
 '" . $idOpcao . "',
 '" . $cargo . "',
 '" . $acesso_new . "',
 '" . $user . "',
 now()
); ";
    }
    $sql = substr($sql, 0, -2);
    $result = mysqli_multi_query($conexao, $sql) or die(false);
    if ($result) {
        echo json_encode("cadastro realizado");
        exit;
    }
}
if($acao == 'buscar_acesso'){ //busca os accessos do cargo
    $sql = " SELECT
            idCargo,
            idOpcao,
            idAcesso,
            statusAcesso
        FROM acesso
        WHERE idCargo = '$cargo'

";
    $result = mysqli_query($conexao, $sql) or die(false);
    $acessos = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($acessos); // retorna em JSoN
}