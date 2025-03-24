<?php
include_once('../controle/controle_session.php'); // Verifica a sessão do usuário
include_once('../controle/funcoes.php'); // Inclui funções auxiliares
include('../modelo/conexao.php'); // Inclui a conexão com o banco de dados

// Busca as opções no banco de dados
$opcoes = buscar_info_bd($conexao, 'opcoes_menu');
$niveisAcesso = buscar_info_bd($conexao, 'nivel_acesso');
$title = "Opções"; // Título da página

include('menu_superior.php'); // Inclui o menu superior
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="../css/stylees.css"> <!-- Seu CSS personalizado -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> <!-- Ícones do Bootstrap -->
</head>
<body>
  <div class="content-box">
    <!-- Título da página -->
    <div class="d-flex justify-content-center mb-4">
      <h1><?php echo $title; ?></h1>
    </div>

    <!-- Tabela de opções -->
    <table class="table table-striped table-bordered table-hover">
      <thead class="thead-dark bg-dark-custom text-white">
        <tr>
          <th scope="col">Descrição</th>
          <th scope="col">URL</th>
          <th scope="col">Nível</th>
          <th scope="col">id Superior</th>
          <th style="text-align:center;">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($opcoes as $opcao): ?>
          <tr>
            <td><?php echo htmlspecialchars($opcao['descricaoOpcao']); ?></td>
            <td><?php echo htmlspecialchars($opcao['urlOpcao']); ?></td>
            <td><?php echo htmlspecialchars($opcao['nivelOpcao']); ?></td>
            <td><?php echo htmlspecialchars($opcao['idOpcaoPai']); ?></td>
            <td>
              <div class="acoes" style="display: flex; justify-content: space-between;">
                <!-- Botão para alterar status -->
                <div class="muda_status">
                  <?php if ($opcao['statusOpcao'] == "S"): ?>
                    <div class="inativo" onclick="muda_status('N', '<?php echo $opcao['idOpcao']; ?>')">
                      <i class="bi bi-toggle-on" style="font-size: 1.5rem; color: green;"></i>
                    </div>
                  <?php else: ?>
                    <div class="ativo" onclick="muda_status('S', '<?php echo $opcao['idOpcao']; ?>')">
                      <i class="bi bi-toggle-off" style="font-size: 1.5rem; color: red;"></i>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Botão para editar -->
                <div class="edit" onclick="editar('<?php echo $opcao['idOpcao']; ?>')">
                  <i class="bi bi-pencil-square" style="font-size: 1.5rem; color: blue;"></i>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Botão para abrir o modal de cadastro -->
    <div class="button-container">
      <button type="button" class="btn btn-primary btn_modal" onclick="limpar_modal()" id="btn_modal" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Cadastrar Opção
      </button>
    </div>
  </div>

  <!-- Inclui o modal de opções -->
  <?php include_once('modal_opcoes.php'); ?>

  <!-- Scripts do Bootstrap e JavaScript personalizado -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/opcoes.js"></script>
</body>
</html>