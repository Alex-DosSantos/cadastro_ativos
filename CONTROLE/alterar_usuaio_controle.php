<?php
include('controle_session.php');
include('../modelo/conexao.php');
$senhaHash = base64_encode($senha);
// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe e sanitiza os dados do formulário
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $turma = mysqli_real_escape_string($conexao, $_POST['turma']);
    $id = (int)$_POST['id'];
    $idCargo = (int)$_POST['cargo']; // Adicionado para receber o cargo

    // Validação básica dos dados
    if (empty($nome) || empty($turma) || empty($id) || empty($idCargo)) {
        echo "<script>alert('Todos os campos são obrigatórios!');
              window.location.href='../visao/editar_usuario.php?id=$id';
              </script>";
        exit;
    }

    // Prepara a query usando prepared statements para evitar SQL injection
    $query = "UPDATE usuario SET 
              nomeUsuario = ?,
              turmaUsuario = ?,
              idCargo = ?
              WHERE idUsuario = ?";
    
    $stmt = mysqli_prepare($conexao, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssii", $nome, $turma, $idCargo, $id);
        $result = mysqli_stmt_execute($stmt);
        
        if ($result) {
            echo "<script>alert('Usuário alterado com sucesso!');
                  window.location.href='../visao/listar_usuario.php';
                  </script>";
        } else {
            echo "<script>alert('Falha ao realizar a alteração!');
                  window.location.href='../visao/editar_usuario.php?id=$id';
                  </script>";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro ao preparar a consulta!');
              window.location.href='../visao/editar_usuario.php?id=$id';
              </script>";
    }
} else {
    // Se não foi POST, redireciona
    header("Location: ../visao/listar_usuario.php");
    exit;
}
?>