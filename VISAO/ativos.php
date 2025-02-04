<?php
include('../controle/controle_session.php');
include('cabecalho.php');
include('../controle/funcoes.php');
include('../modelo/conexao.php');
include ('menu_superior.php');
$marcas = buscar_info_bd($conexao, 'marca');
$tipos = buscar_info_bd($conexao, 'tipo');
$sql = "SELECT            
     `idAtivo`,
     `descricaoAtivo`,
     `quantidadeAtivo`,
     `statusAtivo`,
     `observacaoAtivo`,
     (SELECT descricaoMarca FROM marca m WHERE m.idMarca = a.idMarca) AS marca,
     (SELECT descricaoTipo FROM tipo t WHERE t.idTipo = a.idTipo) AS tipo,
     (SELECT usuario FROM usuario u WHERE u.idUsuario = a.usuarioCadastro) AS usuario,
     `dataCadastro`,
     `usuarioCadastro`
     FROM
     ativos a";
$result = mysqli_query($conexao, $sql) or die(false);
$ativos_bd = $result->fetch_all(MYSQLI_ASSOC);
?>
<script src="../js/ativos.js"></script>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ativos</title>
  
  <!-- Link para o arquivo CSS -->
  <link rel="stylesheet" href="../css/styles.css"> <!-- Caminho para o seu arquivo CSS -->
  
  <!-- Inclusão de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Caixa semi-translúcida com bordas arredondadas para todo o conteúdo -->
    <div class="content-box">
        <h1 class="text-center mb-4">Gerenciamento de Ativos</h1>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark bg-dark-custom text-white">
                <tr>
                    <th scope="col">Descrição</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Observação</th>
                    <th scope="col">Data Cadastro</th>
                    <th scope="col">Usuário Cadastro</th>
                    <th style="text-align:center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($ativos_bd as $ativos) {
                ?>
                    <tr>
                        <td><?php echo $ativos['descricaoAtivo']; ?></td>
                        <td><?php echo $ativos['quantidadeAtivo']; ?></td>
                        <td><?php echo $ativos['marca']; ?></td>
                        <td><?php echo $ativos['tipo']; ?></td>
                        <td><?php echo $ativos['observacaoAtivo']; ?></td>
                        <td><?php   $dataCadastro = $ativos['dataCadastro'];
                                 echo date('d/m/Y H:i:s', strtotime($dataCadastro)); ?></td>
                        <td><?php echo $ativos['usuarioCadastro']; ?></td>
                        <td>
                            <div class="acoes" style="display: flex; justify-content: space-between;">
                                <div class="muda_status"></div>
                                <?php
                                if ($ativos['statusAtivo'] == "S") {
                                ?>
                                    <div class="inativo" onclick="muda_status('N', '<?php echo $ativos['idAtivo']; ?>')">
                                        <i class="bi bi-toggle-on"></i>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="ativo" onclick="muda_status('S', '<?php echo $ativos['idAtivo']; ?>')">
                                        <i class="bi bi-toggle-off"></i>
                                    </div>
                                <?php
                                }
                                ?>
                                <!-- Botão de editar que chama a função para preencher o modal -->
                                <div class="edit" class="inativo" onclick="editar('<?php echo $ativos['idAtivo']; ?>')">
                                    
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <input type="hidden" id="idAtivo" value="">
        <div class="button-container">
            <button type="button" class="btn btn-primary btn_modal" onclick="limpar_modal()" id="btn_modal"data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar Item</button>
        </div>
    </div>
<?php include('modal_ativos.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
