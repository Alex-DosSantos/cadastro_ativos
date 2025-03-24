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
            (SELECT descricaoMarca FROM marca mk WHERE mk.idMarca = a.idMarca) AS marca,
            (SELECT descricaoTipo FROM tipo t WHERE t.idTipo = a.idTipo) AS tipo
        FROM movimentacao m
        INNER JOIN ativos a ON m.idAtivo = a.idAtivo
        WHERE 1=1";

$result = mysqli_query($conexao, $sql) or die(false);
$movimentacoes_bd = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório de Movimentações</title>

  <link rel="stylesheet" href="../css/styles22.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Estilos personalizados */
    .filters {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 15px;
      margin-bottom: 20px;
    }

    .filters label {
      font-weight: bold;
      color: rgb(0, 0, 0); /* Preto para os rótulos */
    }

    .filters select,
    .filters input {
      width: 100%;
      padding: 8px;
      border: 1px solid #fc7f03; /* Laranja escuro para a borda */
      border-radius: 5px;
      font-size: 1rem;
      background-color: #ffffff; /* Fundo branco */
      color: rgb(0, 0, 0); /* Preto para o texto */
    }

    .filters button {
      background-color: #fc7f03; /* Laranja escuro para o botão */
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      grid-column: span 3;
      margin-top: 10px;
      transition: background-color 0.3s ease;
    }

    .filters button:hover {
      background-color: #ffab03; /* Laranja claro no hover */
    }

    .table-hover tbody tr:hover {
      background-color: #ffe6cc; /* Laranja claro suave no hover */
      transition: background-color 0.3s ease;
    }

    .thead-dark.bg-dark-custom {
      background-color: #d1024e !important; /* Rosa escuro para o cabeçalho */
      color: white !important; /* Texto branco */
    }

    .button-container {
      text-align: center;
      margin-top: 30px;
    }

    .btn-exportar {
      background-color: #fc7f03; /* Laranja escuro */
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 30px; /* Bordas arredondadas */
      font-size: 1rem;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
      transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
      text-decoration: none; /* Remove sublinhado do link */
      display: inline-block; /* Garante que o link se comporte como um botão */
    }

    .btn-exportar:hover {
      background-color: #ffab03; /* Laranja claro no hover */
      transform: translateY(-2px); /* Efeito de levantar */
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* Sombra mais intensa no hover */
    }

    .btn-exportar:active {
      transform: translateY(0); /* Efeito de pressionar */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra normal ao clicar */
    }
  </style>
</head>
<body>
  <div class="content-box">
    <h1 class="text-center mb-4">Relatório de Movimentações</h1>

    <!-- Filtros avançados -->
    <form method="GET" action="relatorio.php">
      <div class="filters">
        <div>
          <label for="ativo">Ativo:</label>
          <select id="ativo" name="ativo">
            <option value="">Todos</option>
            <?php
            // Buscar ativos do banco de dados
            $sql_ativos = "SELECT idAtivo, descricaoAtivo FROM ativos";
            $result_ativos = mysqli_query($conexao, $sql_ativos);
            while ($ativo = mysqli_fetch_assoc($result_ativos)) {
              $selected = (isset($_GET['ativo']) && $_GET['ativo'] == $ativo['idAtivo']) ? 'selected' : '';
              echo "<option value='{$ativo['idAtivo']}' $selected>{$ativo['descricaoAtivo']}</option>";
            }
            ?>
          </select>
        </div>
        <div>
          <label for="usuario">Usuário:</label>
          <select id="usuario" name="usuario">
            <option value="">Todos</option>
            <?php
            // Buscar usuários do banco de dados
            $sql_usuarios = "SELECT idUsuario, usuario FROM usuario";
            $result_usuarios = mysqli_query($conexao, $sql_usuarios);
            while ($usuario = mysqli_fetch_assoc($result_usuarios)) {
              $selected = (isset($_GET['usuario']) && $_GET['usuario'] == $usuario['idUsuario']) ? 'selected' : '';
              echo "<option value='{$usuario['idUsuario']}' $selected>{$usuario['usuario']}</option>";
            }
            ?>
          </select>
        </div>
        <div>
          <label for="tipo-movimentacao">Tipo de Movimentação:</label>
          <select id="tipo-movimentacao" name="tipo-movimentacao">
            <option value="">Todos</option>
            <option value="entrada" <?php echo (isset($_GET['tipo-movimentacao']) && $_GET['tipo-movimentacao'] == 'entrada') ? 'selected' : ''; ?>>Entrada</option>
            <option value="saida" <?php echo (isset($_GET['tipo-movimentacao']) && $_GET['tipo-movimentacao'] == 'saida') ? 'selected' : ''; ?>>Saída</option>
            <option value="realocar" <?php echo (isset($_GET['tipo-movimentacao']) && $_GET['tipo-movimentacao'] == 'realocar') ? 'selected' : ''; ?>>Realocado</option>
          </select>
        </div>
        <div>
          <label for="marca">Marca:</label>
          <select id="marca" name="marca">
            <option value="">Todos</option>
            <?php
            // Buscar marcas do banco de dados
            $sql_marcas = "SELECT idMarca, descricaoMarca FROM marca";
            $result_marcas = mysqli_query($conexao, $sql_marcas);
            while ($marca = mysqli_fetch_assoc($result_marcas)) {
              $selected = (isset($_GET['marca']) && $_GET['marca'] == $marca['idMarca']) ? 'selected' : '';
              echo "<option value='{$marca['idMarca']}' $selected>{$marca['descricaoMarca']}</option>";
            }
            ?>
          </select>
        </div>
        <div>
          <label for="tipo">Tipo:</label>
          <select id="tipo" name="tipo">
            <option value="">Todos</option>
            <?php
            // Buscar tipos do banco de dados
            $sql_tipos = "SELECT idTipo, descricaoTipo FROM tipo";
            $result_tipos = mysqli_query($conexao, $sql_tipos);
            while ($tipo = mysqli_fetch_assoc($result_tipos)) {
              $selected = (isset($_GET['tipo']) && $_GET['tipo'] == $tipo['idTipo']) ? 'selected' : '';
              echo "<option value='{$tipo['idTipo']}' $selected>{$tipo['descricaoTipo']}</option>";
            }
            ?>
          </select>
        </div>
        <div>
          <label for="data-inicial">Data Inicial:</label>
          <input type="date" id="data-inicial" name="data-inicial" value="<?php echo isset($_GET['data-inicial']) ? $_GET['data-inicial'] : ''; ?>">
        </div>
        <div>
          <label for="data-final">Data Final:</label>
          <input type="date" id="data-final" name="data-final" value="<?php echo isset($_GET['data-final']) ? $_GET['data-final'] : ''; ?>">
        </div>
        <div>
          <label for="local-origem">Local de Origem:</label>
          <input type="text" id="local-origem" name="local-origem" value="<?php echo isset($_GET['local-origem']) ? $_GET['local-origem'] : ''; ?>">
        </div>
        <div>
          <label for="local-destino">Local de Destino:</label>
          <input type="text" id="local-destino" name="local-destino" value="<?php echo isset($_GET['local-destino']) ? $_GET['local-destino'] : ''; ?>">
        </div>
        <button type="submit">Filtrar</button>
      </div>
    </form>

    <!-- Tabela de dados -->
    <table class="table table-striped table-bordered table-hover">
      <thead class="thead-dark bg-dark-custom text-white">
        <tr>
          <th scope="col">Ativo</th>
          <th scope="col">Descrição</th>
          <th scope="col">Quantidade</th>
          <th scope="col">Tipo</th>
          <th scope="col">Marca</th>
          <th scope="col">Tipo</th>
          <th scope="col">Origem</th>
          <th scope="col">Destino</th>
          <th scope="col">Data</th>
          <th scope="col">Usuário</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Aplicar filtros
        $filtro_sql = "";
        if (isset($_GET['ativo']) && !empty($_GET['ativo'])) {
          $filtro_sql .= " AND m.idAtivo = '{$_GET['ativo']}'";
        }
        if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
          $filtro_sql .= " AND m.idUsuario = '{$_GET['usuario']}'";
        }
        if (isset($_GET['tipo-movimentacao']) && !empty($_GET['tipo-movimentacao'])) {
          $filtro_sql .= " AND m.tipoMovimentacao = '{$_GET['tipo-movimentacao']}'";
        }
        if (isset($_GET['marca']) && !empty($_GET['marca'])) {
          $filtro_sql .= " AND a.idMarca = '{$_GET['marca']}'";
        }
        if (isset($_GET['tipo']) && !empty($_GET['tipo'])) {
          $filtro_sql .= " AND a.idTipo = '{$_GET['tipo']}'";
        }
        if (isset($_GET['data-inicial']) && !empty($_GET['data-inicial'])) {
          $filtro_sql .= " AND m.dataMovimentacao >= '{$_GET['data-inicial']}'";
        }
        if (isset($_GET['data-final']) && !empty($_GET['data-final'])) {
          // Adiciona um dia à data final para incluir o dia inteiro
          $data_final = date('Y-m-d', strtotime($_GET['data-final'] . ' +1 day'));
          $filtro_sql .= " AND m.dataMovimentacao < '{$data_final}'";
        }
        if (isset($_GET['local-origem']) && !empty($_GET['local-origem'])) {
          $filtro_sql .= " AND m.localOrigem LIKE '%{$_GET['local-origem']}%'";
        }
        if (isset($_GET['local-destino']) && !empty($_GET['local-destino'])) {
          $filtro_sql .= " AND m.localDestino LIKE '%{$_GET['local-destino']}%'";
        }

        // Consulta com filtros
        $sql_filtrado = $sql . $filtro_sql;
        $result_filtrado = mysqli_query($conexao, $sql_filtrado);
        $movimentacoes_filtradas = $result_filtrado->fetch_all(MYSQLI_ASSOC);

        foreach ($movimentacoes_filtradas as $movimentacao) {
        ?>
          <tr>
            <td><?php echo $movimentacao['ativo']; ?></td>
            <td><?php echo $movimentacao['descricaoMovimentacao']; ?></td>
            <td><?php echo $movimentacao['quantidadeMov']; ?></td>
            <td><?php echo $movimentacao['tipoMovimentacao']; ?></td>
            <td><?php echo $movimentacao['marca']; ?></td>
            <td><?php echo $movimentacao['tipo']; ?></td>
            <td><?php echo $movimentacao['localOrigem']; ?></td>
            <td><?php echo $movimentacao['localDestino']; ?></td>
            <td><?php echo date('d/m/Y H:i:s', strtotime($movimentacao['dataMovimentacao'])); ?></td>
            <td><?php echo $movimentacao['usuario']; ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

    <!-- Botão de exportar -->
    <div class="button-container">
      <a href="gerarPdf.php?<?php echo http_build_query($_GET); ?>" class="btn-exportar">Exportar Relatório</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>