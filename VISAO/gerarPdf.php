<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);
include('../modelo/conexao.php');
include('controle_session.php');
$title =  "Relatório Gerado";
include('menu_superior.php');

// Capturar os filtros da URL
$filtros = $_GET;

// Consultar dados das movimentações com os filtros aplicados
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
            (SELECT descricaoMarca FROM marca mk WHERE mk.idMarca = a.idMarca) AS marca,
            (SELECT descricaoTipo FROM tipo t WHERE t.idTipo = a.idTipo) AS tipo,
            (SELECT usuario FROM usuario u WHERE u.idUsuario = m.idUsuario) AS usuario,
            a.descricaoAtivo AS ativo
        FROM movimentacao m
        INNER JOIN ativos a ON m.idAtivo = a.idAtivo
        WHERE 1=1";

if (isset($filtros['ativo']) && !empty($filtros['ativo'])) {
    $sql .= " AND m.idAtivo = '{$filtros['ativo']}'";
}
if (isset($filtros['usuario']) && !empty($filtros['usuario'])) {
    $sql .= " AND m.idUsuario = '{$filtros['usuario']}'";
}
if (isset($filtros['tipo-movimentacao']) && !empty($filtros['tipo-movimentacao'])) {
    $sql .= " AND m.tipoMovimentacao = '{$filtros['tipo-movimentacao']}'";
}
if (isset($filtros['data-inicial']) && !empty($filtros['data-inicial'])) {
    $sql .= " AND m.dataMovimentacao >= '{$filtros['data-inicial']}'";
}
if (isset($filtros['data-final']) && !empty($filtros['data-final'])) {
    $sql .= " AND m.dataMovimentacao <= '{$filtros['data-final']}'";
}
if (isset($filtros['local-origem']) && !empty($filtros['local-origem'])) {
    $sql .= " AND m.localOrigem LIKE '%{$filtros['local-origem']}%'";
}
if (isset($filtros['local-destino']) && !empty($filtros['local-destino'])) {
    $sql .= " AND m.localDestino LIKE '%{$filtros['local-destino']}%'";
}

$result = mysqli_query($conexao, $sql);
$movimentacoes = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?php echo $title; ?></title>
  
  <link rel="stylesheet" href="../css/styles2.css">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.1/css/buttons.dataTables.css" />
  
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.1/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.print.min.js"></script>
 


  <script>
  $(document).ready( function () {
    $('#myTable').DataTable({
      layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
    });
} );

  </script>
  
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
      color: rgb(0, 0, 0);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #d1024e;
      color: white;
    }

    .button-container {
      text-align: center;
      margin-top: 30px;
    }

    .btn-voltar {
      background-color: #fc7f03;
      /* Laranja escuro */
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 30px;
      /* Bordas arredondadas */
      font-size: 1rem;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      /* Sombra suave */
      transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    }

    .btn-voltar:hover {
      background-color: #ffab03;
      /* Laranja claro no hover */
      transform: translateY(-2px);
      /* Efeito de levantar */
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
      /* Sombra mais intensa no hover */
    }

    .btn-voltar:active {
      transform: translateY(0);
      /* Efeito de pressionar */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      /* Sombra normal ao clicar */
    }
  </style>
</head>
<body>
  <div class="content-box">
    <h1>Relatório Gerado de Movimentações</h1>
    <table id="myTable" class="display">
      <thead>
        <tr>
          <th>Ativo</th>
          <th>Descrição</th>
          <th>Quantidade Uso</th>
          <th>Quantidade Mov</th>
          <th>Tipo Mov</th>
          <th>Tipo</th>
          <th>Marca</th>
          <th>Origem</th>
          <th>Destino</th>
          <th>Data</th>
          <th>Usuário</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($movimentacoes as $movimentacao) {
          echo '
            <tr>
                <td>' . $movimentacao['ativo'] . '</td>
                <td>' . $movimentacao['descricaoMovimentacao'] . '</td>
                <td>' . $movimentacao['quantidadeUso'] . '</td>
                <td>' . $movimentacao['quantidadeMov'] . '</td>
                <td>' . ($movimentacao['tipoMovimentacao'] == 'entrada' ? 'Entrada' : 'Saída') . '</td>
                <td>' . $movimentacao['tipo'] . '</td>
                <td>' . $movimentacao['marca'] . '</td>
                <td>' . $movimentacao['localOrigem'] . '</td>
                <td>' . $movimentacao['localDestino'] . '</td>
                <td>' . date('d/m/Y H:i:s', strtotime($movimentacao['dataMovimentacao'])) . '</td>
                <td>' . $movimentacao['usuario'] . '</td>
            </tr>';
        }
        ?>
      </tbody>
    </table>
    <!-- Botão de Voltar -->
    <div class="button-container">
      <button class="btn-voltar" onclick="voltar()">Voltar</button>
    </div>
  </div>

  <script>
    // Função para voltar à página anterior
    function voltar() {
      window.history.back(); // Volta para a página anterior
    }
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>