<?php
include_once ('../controle/controle_session.php');
include_once ('../controle/funcoes.php');
include ('../modelo/conexao.php');
$tipos = buscar_info_bd($conexao, 'tipo');
$title = "Tipos";

include ('menu_superior.php');
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tipos</title>
  
  
  <link rel="stylesheet" href="../css/styleees.css"> 
  
  
  
</head>
<script src="../js/tipos.js"></script>
<body>
    
    <div class="content-box">
        
        <div class="d-flex justify-content-center mb-4">
            <h1 class="text-center">Tipos</h1>
        </div>


        <div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark bg-dark-custom text-white">
                <tr>
                    <th scope="col">Tipos</th>
                    <th style="text-align:center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($tipos as $tipo) {
                ?>
                    <tr>
                        <td><?php echo $tipo['descricaoTipo']; ?></td>
                        <td>
                            <div class="acoes" style="display: flex; justify-content: space-between;">
                                <div class="muda_status"></div>
                                <?php
                                if ($tipo['statusTipo'] == "S") {
                                ?>
                                    <div class="inativo" onclick="muda_status('N', '<?php echo $tipo['idTipo']; ?>')">
                                        <i class="bi bi-toggle-on"></i>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="ativo" onclick="muda_status('S', '<?php echo $tipo['idTipo']; ?>')">
                                        <i class="bi bi-toggle-off"></i>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="edit" onclick="editar('<?php echo $tipo['idTipo']; ?>')">
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
        </div>
        
        <div class="button-container">
            <button type="button" class="btn btn-primary btn_modal" onclick="limpar_modal()" id="btn_modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar Tipo</button>
        </div>  
    </div>
        <!-- Espaço para o modal -->
        <?php include_once ('modal_tipo.php'); ?>
    </div>
</body>
