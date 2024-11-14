<?php

include ('../modelo/conexao.php');

$nome = $_POST['nome'];
$turma = $_POST['turma'];
$id = $_POST['id'];

$senhaHash = password_hash($senha, PASSWORD_BCRYPT);

$query = "
 UPDATE 
   usuario 
  set 
  nomeUsuario = '".$nome."',
   turmaUsuario = '".$turma."'
 WHERE
  idUsuario = ".$id."

 
    
";
$result = mysqli_query($conexao, $query) or die (false);
if ($result) {
     echo "<script> alert('usuario alterado com sucesso!');
            window.location.href='../visao/listar_usuario.php';
          </script>";
     
} else { 
     echo "<script>alert('Falha ao realizar o alteracao!');
       window.location.href='../visao/cadastro_usuario.php?idUsuario=$id';
           </script>";
     
}
  ?>