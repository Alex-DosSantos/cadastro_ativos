<?php
session_start();
include ('../modelo/conexao.php');

$senha = $_POST['senha'];
$usuario = $_POST['user'];

$senhacrip = base64_encode($senha);


$sql = "Select
 count(*) as quantidade,
      idUsuario
    from
        usuario
    where
       usuario = '$usuario' 
       and senhaUsuario = '$senhacrip'";

$result = mysqli_query($conexao, $sql) or die (false);
$dados = $result ->fetch_assoc();
if($dados['quantidade'] > 0){
    $_SESSION['login_ok'] = true;
    $_SESSION['controle_login'] = true;
    $_SESSION['id_user'] = $dados['idUsuario'];
    header('location:../index.php');
   
}else{
    $_SESSION['login_ok'] = false;
    unset ($_SESSION['controle_login']);
    header('location:../visao/login.php?error_auten=s');
}

?>