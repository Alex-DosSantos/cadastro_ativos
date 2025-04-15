<?php
include_once('../controle/controle_session.php'); // Verifica a sessão do usuário
include_once('../controle/funcoes.php'); // Inclui funções auxiliares
include('../modelo/conexao.php'); // Inclui a conexão com o banco de dados

// Busca as opções no banco de dados
$opcoes = buscar_info_bd($conexao, 'opcoes_menu', 'nivelOpcao',  '1');
$niveisAcesso = buscar_info_bd($conexao, 'nivel_acesso');
foreach($niveisAcesso as $nivel){
  $array_nivel[$nivel['idNivel']] = $nivel['descricaoNivel'];
}

$title = "Opções"; // Título da página
$novoArr = [];
foreach ($opcoes as $row) {
  $novoArr[$row['idOpcao']]['DESCR_OPCAO'] = $row['descricaoOpcao'];
  $novoArr[$row['idOpcao']]['NIVEL_OPCAO'] = $row['nivelOpcao'];
  $novoArr[$row['idOpcao']]['URL_OPCAO'] = $row['urlOpcao'];
  $novoArr[$row['idOpcao']]['STATUS_OPCAO'] = $row['statusOpcao'];
  $novoArr[$row['idOpcao']]['ID_OPCAO_PAI'] = $row['idOpcaoPai'];
  $novoArr[$row['idOpcao']]['DESCR_NIVEL'] = $array_nivel [$row['nivelOpcao']];
   
  $opcoesSub = buscar_info_bd($conexao, 'opcoes_menu', 'idOpcaoPai', $row['idOpcao']);

  foreach ($opcoesSub as $sub) {
    $novoArr[$sub['idOpcao']]['DESCR_OPCAO'] = $sub['descricaoOpcao'];
    $novoArr[$sub['idOpcao']]['NIVEL_OPCAO'] = $sub['nivelOpcao'];
    $novoArr[$sub['idOpcao']]['URL_OPCAO'] = $sub['urlOpcao'];
    $novoArr[$sub['idOpcao']]['STATUS_OPCAO'] = $sub['statusOpcao'];
    $novoArr[$sub['idOpcao']]['ID_OPCAO_PAI'] = $sub['idOpcaoPai'];
    $novoArr[$sub['idOpcao']]['DESCR_NIVEL'] = $array_nivel [$sub['nivelOpcao']];
    $opcoesOp = buscar_info_bd($conexao, 'opcoes_menu', 'idOpcaoPai', $sub['idOpcao']);

    foreach ($opcoesOp as $opcao) {
      $novoArr[$opcao['idOpcao']]['DESCR_OPCAO'] = $opcao['descricaoOpcao'];
      $novoArr[$opcao['idOpcao']]['NIVEL_OPCAO'] = $opcao['nivelOpcao'];
      $novoArr[$opcao['idOpcao']]['URL_OPCAO'] = $opcao['urlOpcao'];
      $novoArr[$opcao['idOpcao']]['STATUS_OPCAO'] = $opcao['statusOpcao'];
      $novoArr[$opcao['idOpcao']]['ID_OPCAO_PAI'] = $opcao['idOpcaoPai'];
      $novoArr[$opcao['idOpcao']]['DESCR_NIVEL'] = $array_nivel [$opcao['nivelOpcao']];
    }
  }
}

include('menu_superior.php'); // Inclui o menu superior
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="../css/stylees2.css"> <!-- Seu CSS personalizado -->
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> <!-- Ícones do Bootstrap -->
</head>
<style>
  /* Estilos responsivos */
@media (max-width: 992px) {
    .content-box {
        padding: 15px;
    }
    
    .table {
        font-size: 0.9rem;
    }
}

@media (max-width: 768px) {
    .content-box {
        padding: 10px;
    }
    
    /* Tabela responsiva - transforma em cards */
    .table thead {
        display: none;
    }
    
    .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%;
    }
    
    .table tr {
        margin-bottom: 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }
    
    .table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
        border: none;
        border-bottom: 1px solid #eee;
    }
    
    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        width: 45%;
        padding-right: 10px;
        font-weight: bold;
        text-align: left;
    }
    
    /* Ajusta os paddings para os níveis */
    .table td[style*="padding-left"] {
        padding-left: 30% !important;
    }
    
    .acoes {
        justify-content: space-evenly;
    }
}

@media (max-width: 576px) {
    .content-box {
        padding: 5px;
    }
    
    .table td {
        padding-left: 40%;
    }
    
    .table td::before {
        width: 35%;
    }
    
    .button-container {
        text-align: center;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 10px;
    }
}

</style>
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
        <?php foreach ($novoArr as $chave => $opcao):
            $nivel = $opcao['NIVEL_OPCAO'];
            $descr_nivel = $opcao['DESCR_NIVEL'];
            $id = $chave;
            $descr_opcao = $opcao['DESCR_OPCAO'];
            $url = $opcao ['URL_OPCAO'];
            $status = $opcao['STATUS_OPCAO'];
            $pai = $opcao['ID_OPCAO_PAI'];
          if ($nivel == 1) {
            $padding = '';
          } else if ($nivel == 2) {
            $padding = 'padding-left:30px;';
          } else if ($nivel = 3) {
            $padding = 'padding-left:45px;';
          };
        ?>
          <tr>

            <td style="text-align: left;<?php echo $padding ?>"><?php echo htmlspecialchars($descr_opcao); ?></td>
            <td data-label="URL"><?php echo htmlspecialchars($url); ?></td>
            <td data-label="Nível"><?php echo htmlspecialchars($nivel); ?></td>
            <td data-label="Superior"><?php echo htmlspecialchars($pai); ?></td>
            <td data-label="Ações">
              <div class="acoes" style="display: flex; justify-content: space-between;">
                <!-- Botão para alterar status -->
                <div class="muda_status">
                  <?php if ($status == "S"): ?>
                    <div class="inativo" onclick="muda_status('N', '<?php echo $id; ?>')">
                      <i class="bi bi-toggle-on" style="font-size: 1.5rem; color: green;"></i>
                    </div>
                  <?php else: ?>
                    <div class="ativo" onclick="muda_status('S', '<?php echo $id; ?>')">
                      <i class="bi bi-toggle-off" style="font-size: 1.5rem; color: red;"></i>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Botão para editar -->
                <div class="edit" onclick="editar('<?php echo $id; ?>')">
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
  
  <script src="../js/opcoes.js"></script>
</body>

</html>