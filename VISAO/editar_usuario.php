<?php
include ('../controle/controle_session.php');
include('../modelo/conexao.php'); 
include('../controle/funcoes.php'); 

if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];
    $result = buscar_info_bd($conexao, 'usuario', 'idUsuario', $idUsuario); // Busca os dados do usuário no banco de dados
    $cargoUser = buscar_info_bd($conexao, 'cargo');

    // Verifica se o usuário existe
    if (count($result) == 0) {
        echo "Usuário não encontrado.";
        exit;
    }
} else {
    echo "ID não fornecido.";
    exit;
}

foreach ($result as $user) {
    $turma = $user["turmaUsuario"];
    $nome = $user["nomeUsuario"];
    $id = $user["idUsuario"];
    $idCargo = $user["idCargo"]; 
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listar Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/stylees.css"> 
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Usuário</h1>
        <form action="../controle/alterar_usuaio_controle.php" method="POST">
            
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome; ?>" required>
            </div>

            
            <div class="form-group">
                <label for="turma">Turma</label>
                <input type="text" class="form-control" name="turma" id="turma" value="<?php echo $turma; ?>" required>
            </div>
            <div class="mb-3">
            <label for="cargo" class="col-form-label">Cargo:<span class="asterisco-vermelho">*</span></label>
            <select class="form-select" id="cargo" name="cargo" required onchange="verificarCargo(this.value)">
              <option value="">Selecione o Cargo</option>
              <?php foreach ($cargoUser as $cargo): ?>
                <option value="<?php echo $cargo['idCargo']; ?>" <?php echo ($cargo['idCargo'] == $idCargo) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($cargo['descricaoCargo']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
            
            
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" required>
            

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="listar_usuario.php" class="btn btn-secondary">Cancelar</a> 
        </form>
    </div>
</body>
</html>