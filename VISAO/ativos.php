<?php
include('../controle/controle_session.php');
include('cabecalho.php');
include('../controle/funcoes.php');
include('../modelo/conexao.php');
include('menu_superior.php');
$marcas = buscar_info_bd($conexao, 'marca');
$tipos = buscar_info_bd($conexao, 'tipo');

// Busca as informações dos ativos no banco de dados
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
    FROM ativos a";
$result = mysqli_query($conexao, $sql) or die(false);
$ativos_bd = $result->fetch_all(MYSQLI_ASSOC);

// Verifica a quantidade mínima e disponível
$sql = "
    SELECT
    idAtivo,
    quantidadeAtivo,
    quantidadeMinAtivo,
    descricaoAtivo,
    (SELECT descricaoMarca FROM marca ma WHERE ma.idMarca = a.idMarca ) as descr_marca
    FROM ativos a
    ";
if (isset($_GET['idAtivo'])) {
    $sql .= ' WHERE a.idAtivo ='.$_GET['idAtivo'].'';
}

$result = mysqli_query($conexao, $sql) or die(false);
$ativos = $result->fetch_all(MYSQLI_ASSOC);

// Array para armazenar os IDs dos ativos que estão abaixo da quantidade mínima
$alertas = [];

foreach ($ativos as $ativo) {
    $quantidade_disponivel = $ativo['quantidadeAtivo'] - $ativo['quantidadeMinAtivo'];
    if ($quantidade_disponivel < $ativo['quantidadeMinAtivo'] && !isset($_GET['idAtivo'])) {
        $alertas[] = $ativo['idAtivo']; // Armazena o ID do ativo com problema
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ativos</title>
    <link rel="stylesheet" href="../css/styles.css">
    
    <style>
        .hidden {
            display: none;
        }
        .search {
            cursor: pointer;
            margin-left: 10px;
        }
        .search i {
            font-size: 1.2em;
            color: #007bff;
        }
        .alert-icon {
            color: #ffc107;
            cursor: pointer;
            margin-left: 10px;
        }
        
        /* Estilos responsivos */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .acoes {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        
        .acoes > div {
            margin: 2px;
        }
        
        @media (max-width: 768px) {
            .content-box {
                padding: 10px;
            }
            
            .table thead {
                display: none;
            }
            
            .table, .table tbody, .table tr, .table td {
                display: block;
                width: 100%;
            }
            
            .table tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
            }
            
            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
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
            
            .button-container {
                text-align: center;
            }
            
            .btn_modal {
                width: 100%;
                margin-bottom: 10px;
            }
        }
        
        @media (max-width: 576px) {
            .acoes {
                justify-content: space-between;
            }
            
            .acoes > div {
                margin: 0;
            }
        }
    </style>
</head>
<body style="background-color:#e2e0db;">
    <div class="content-box">
        <h1 class="text-center mb-4">Gerenciamento de Ativos</h1>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark bg-dark-custom text-white">
                    <tr>
                        <th scope="col">Descrição</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Tipo</th>
                        <th class="observacao-header hidden" scope="col">Observação</th>
                        <th class="data-cadastro-header hidden" scope="col">Data Cadastro</th>
                        <th class="usuario-cadastro-header hidden" scope="col">Usuário Cadastro</th>
                        <th style="text-align:center;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ativos_bd as $ativos) { ?>
                        <tr>
                            <td data-label="Descrição"><?php echo $ativos['descricaoAtivo']; ?></td>
                            <td data-label="Quantidade"><?php echo $ativos['quantidadeAtivo']; ?></td>
                            <td data-label="Marca"><?php echo $ativos['marca']; ?></td>
                            <td data-label="Tipo"><?php echo $ativos['tipo']; ?></td>
                            <td class="hidden observacao" data-label="Observação"><?php echo $ativos['observacaoAtivo']; ?></td>
                            <td class="hidden data-cadastro" data-label="Data Cadastro">
                                <?php echo date('d/m/Y H:i:s', strtotime($ativos['dataCadastro'])); ?>
                            </td>
                            <td class="hidden usuario-cadastro" data-label="Usuário Cadastro"><?php echo $ativos['usuarioCadastro']; ?></td>
                            <td data-label="Ações">
                                <div class="acoes">
                                    <div class="muda_status"></div>
                                    <?php if ($ativos['statusAtivo'] == "S") { ?>
                                        <div class="inativo" onclick="muda_status('N', '<?php echo $ativos['idAtivo']; ?>')">
                                            <i class="bi bi-toggle-on"></i>
                                        </div>
                                    <?php } else { ?>
                                        <div class="ativo" onclick="muda_status('S', '<?php echo $ativos['idAtivo']; ?>')">
                                            <i class="bi bi-toggle-off"></i>
                                        </div>
                                    <?php } ?>
                                    <div class="edit" onclick="editar('<?php echo $ativos['idAtivo']; ?>')">
                                        <i class="bi bi-pencil-square"></i>
                                    </div>
                                    <div class="search" onclick="buscarAtivo('<?php echo $ativos['idAtivo']; ?>')">
                                        <i class="bi bi-search"></i>
                                    </div>
                                    <div class="toggle-info" onclick="busca_detalhe('<?php echo $ativos['idAtivo']; ?>')" data-bs-toggle="tooltip" title="Mostrar/Esconder informações">
                                        <i class="bi bi-eye"></i>
                                    </div>
                                    <?php if (in_array($ativos['idAtivo'], $alertas)) { ?>
                                        <div class="alert-icon" data-bs-toggle="tooltip" title="Estoque baixo!">
                                            <i class="bi bi-exclamation-triangle"></i>
                                        </div>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <input type="hidden" id="idAtivo" value="">
        <div class="button-container">
            <button type="button" class="btn btn-primary btn_modal" onclick="limpar_modal()" id="btn_modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar Item</button>
        </div>
    </div>
    <?php include('modal_ativos.php');
    include('modal_ativos_detalhe.php');
    ?>

    <script src="../js/ativos.js"></script>
    <script>
        // Inicializa os tooltips do Bootstrap
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>