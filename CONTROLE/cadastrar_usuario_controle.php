<?php
include ('../modelo/conexao.php');

$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = $_POST['senha']; 
$turma = $_POST['turma'];

$senhaHash = password_hash($senha, PASSWORD_BCRYPT);

$query = "
    insert into usuario (
    nomeUsuario,
    usuario,
    senhaUsuario,
    turmaUsuario,
    dataCadastro
    ) values (
    '".$nome."',
    '".$usuario."',
    '".$senhaHash."',
    '".$turma."',
 NOW()
    )
";
$result = mysqli_query($conexao, $query) or die (false);
if ($result) {
     echo "<script> alert('Cadastro realizado com sucesso!');
            window.location.href='../visao/listar_usuario.php';
          </script>";
     
} else { 
     echo "<script>alert('Falha ao realizar o cadastro!');
       window.location.href='../visao/cadastro_usuario.php';
           </script>";
     
}








?>