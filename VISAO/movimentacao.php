<?php
  include('../controle/controle_session.php');
  include('cabecalho.php');
  include('../controle/funcoes.php');
  include('../modelo/conexao.php');
  include('menu_superior.php');

  $sql = "SELECT
              m.idMovimentacao,
              m.idUsuario,
              m.idAtivo,
              m.localOrigem,
              m.localDestino,
              m.dataMovimentacao,
              m.descricaoMovimentacao,
              m.quantidadeUso,
              m.quantidadeMov,
              m.tipoMovimentacao,
              m.statusMov,
              (SELECT usuario FROM usuario u WHERE u.idUsuario = m.idUsuario) AS usuario,
              (SELECT descricaoAtivo FROM ativos a WHERE a.idAtivo = m.idAtivo) AS ativo,
              (SELECT quantidadeAtivo FROM ativos a WHERE a.idAtivo = m.idAtivo) AS quantidadeTotalAtivo
          FROM movimentacao m";

  $result = mysqli_query($conexao, $sql) or die(false);
  $movimentacoes_bd = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentações</title>
    <link rel="stylesheet" href="../css/styles1.css">
    <style>
        @media (max-width: 768px) {
            .table thead { display: none; }
            .table tr { display: block; margin-bottom: 1rem; }
            .table td { 
                display: block; 
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <div class="content-box">
      <h1 class="text-center mb-4">Controle de Movimentações</h1>
      <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark bg-dark-custom text-white">
          <tr>
            <th scope="col">Ativo</th>
            <th scope="col">Descrição</th>
            <th scope="col">Quantidade Total</th>
            <th scope="col">Quantidade Uso</th>
            <th scope="col">Quantidade Mov</th>
            <th scope="col">Tipo</th>
            <th scope="col">Origem</th>
            <th scope="col">Destino</th>
            <th scope="col">Data</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($movimentacoes_bd as $movimentacao) {
          ?>
            <tr>
              <td data-label="Ativo"><?php echo $movimentacao['ativo']; ?></td>
              <td data-label="Descrição"><?php echo $movimentacao['descricaoMovimentacao']; ?></td>
              <td data-label="Qtd Total"><?php echo $movimentacao['quantidadeTotalAtivo'];?></td>
              <td data-label="Qtd Uso"><?php echo $movimentacao['quantidadeUso'];?></td>
              <td data-label="Qtd Mov"><?php echo $movimentacao['quantidadeMov']; ?></td>
              <td data-label="Tipo"><?php echo $movimentacao['tipoMovimentacao']; ?></td>
              <td data-label="Origem"><?php echo $movimentacao['localOrigem']; ?></td>
              <td data-label="Destino"><?php echo $movimentacao['localDestino']; ?></td>
              <td data-label="Data"><?php echo date('d/m/Y H:i:s', strtotime($movimentacao['dataMovimentacao'])); ?></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
      <input type="hidden" id="idMovimentacao" value="">
      <div class="button-container">
        <button type="button" class="btn btn-primary btn_modal" onclick="limpar_modal()" data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar Movimentação</button>
      </div>
    </div>
    <?php include('modal_movimentacoes.php'); ?>
    <script src="../js/movimentacao.js"></script>
</body>
</html>