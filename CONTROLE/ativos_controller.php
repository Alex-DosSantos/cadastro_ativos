<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);
include('../modelo/conexao.php');
include('controle_session.php');
$ativo = $_POST['ativo'];
$quantidade = $_POST['quantidade'];
$quantidadeMinAtivo = $_POST['quantidadeMinAtivo'];
$marca = $_POST['marca'];
$tipo = $_POST['tipo'];
$obs = $_POST['obs'];
$user = $_SESSION['id_user'];
$acao = $_POST['acao'];
$idAtivo = $_POST['idAtivo'];
$statusAtivo = $_POST['status'];
$img = $_FILES['img'];





if ($acao == 'inserir') {

    $pasta_base = $_SERVER['DOCUMENT_ROOT'] . '/aulasenac/cadastro senac projeto ivan/img_ativo/';
    if (!file_exists($pasta_base)) {
        mkdir($pasta_base);
    }
    $data = date("YmdHis");
    $tipoImagem = $img['type'];
    $quebratipo = explode('/', $tipoImagem);
    $extencao = $quebratipo[1];
    $result = move_uploaded_file($img['tmp_name'], $pasta_base . $data . '.' . $extencao);
    if ($result == false) {
        echo "Erro ao fazer upload da imagem";
        exit();
    }
    $urlImg = '/aulasenac/cadastro senac projeto ivan/img_ativo/' . $data . '.' . $extencao;



    $query = "
    insert into ativos (
    descricaoAtivo,
    quantidadeAtivo,
    quantidadeMinAtivo,
    statusAtivo,
    observacaoAtivo,
    urlImagem,
    idMarca,
    idTipo,
    dataCadastro,
    usuarioCadastro
    ) values (
    '" . $ativo . "',
    '" . $quantidade . "',
    '" . $quantidadeMinAtivo . "',
    'S',
    '" . $obs . "',
    '" . $urlImg . "',
    '" . $marca . "',
    '" . $tipo . "',
 NOW(),
 '" . $user . "'
    )
";
    $result = mysqli_query($conexao, $query) or die(false);
    if ($result) {
        echo "cadastro realizado";
    }
}
if ($acao == 'alterar_status') {
    $sql = "
    UPDATE ativos
    SET statusAtivo = '$statusAtivo'
     WHERE
      idAtivo = $idAtivo
    ";
    $result = mysqli_query($conexao, $sql) or die(false);
    if ($result) {
        echo "status alterado";
    }
}

if ($acao == 'get_info') {
    $sql = "
    SELECT
        descricaoAtivo,
        quantidadeAtivo,
        quantidadeMinAtivo,
        statusAtivo,
        observacaoAtivo,
        urlImagem,
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

if ($acao == 'update') {
    if ($img != null) {
        $sql_remove = "SELECT urlImagem FROM ativos WHERE idAtivo = $idAtivo";
        $result_remove = mysqli_query($conexao, $sql_remove) or die(false);
        $info = $result_remove->fetch_all(MYSQLI_ASSOC);
        $img_antiga = $_SERVER['DOCUMENT_ROOT'] . '/' . $info[0]['urlImagem'];
        unlink($img_antiga);

        $pasta_base = $_SERVER['DOCUMENT_ROOT'] . '/aulasenac/cadastro senac projeto ivan/img_ativo/';
         
        $data = date("YmdHis");
        $tipoImagem = $img['type'];
        $quebratipo = explode('/', $tipoImagem);
        $extencao = $quebratipo[1];

        $result = move_uploaded_file($img['tmp_name'], $pasta_base . $data . '.' . $extencao);
        if ($result == false) {
            echo "Erro ao fazer upload da imagem nova";
            exit();
        }
        $urlImg = '/aulasenac/cadastro senac projeto ivan/img_ativo/' . $data . '.' . $extencao;
        $completa_sql = ", urlImagem='$urlImg'";
    } else {
        $completa_sql = "";
    }
    $sql = "
    UPDATE ativos set
    descricaoAtivo='$ativo',
    idMarca='$marca',
    idTipo='$tipo',
    quantidadeAtivo='$quantidade',
    quantidadeMinAtivo='$quantidadeMinAtivo',
    observacaoAtivo='$obs'";
    $sql .= $completa_sql;
    $sql .= "
     WHERE
      idAtivo = $idAtivo
    ";
    
    $result = mysqli_query($conexao, $sql) or die(false);
    if ($result) {
        echo "informações alteradas";
    }
}
