<?php
include ('../modelo/conexao.php');
include ('../controle/funcoes.php');
$senha = $_POST['senha'];
$usuario = $_POST['user'];

$senhacrip = base64_encode($senha);

$sql = "Select
 count (*) as quantidade
    from
        usuario
    where
       usuario = '$usuario' 
       and senhaUsuario = '$senhacrip'";

$result = mysqli_query($conexao, $sql) or die (false);
$dados = $result ->fetch_all(MYSQLI_ASSOC);
if($dados['quantidade'] > 0){
    echo 'Login realizado com sucesso!';
}else{
    echo 'Usuario ou senha inválidos!';
}

?>