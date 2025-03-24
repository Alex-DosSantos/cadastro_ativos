<?php
include_once ('../controle/controle_session.php');
include_once ('../controle/funcoes.php');
include ('../modelo/conexao.php');
$marcas = buscar_info_bd($conexao, 'marca');
$title = "Marcas";

include ('menu_superior.php');
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marcas</title>
  
 
  <link rel="stylesheet" href="../css/stylees.css"> 
  
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="../js/marcas.js"></script>
<body>
    
    <div class="content-box">
        
        <div class="d-flex justify-content-center mb-4">
            <h1>Marcas</h1>
        </div>


        
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark bg-dark-custom text-white">
                <tr>
                    <th scope="col">Marca</th>
                    <th style="text-align:center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($marcas as $marca) {
                ?>
                    <tr>
                        <td><?php echo $marca['descricaoMarca']; ?></td>
                        <td>
                            <div class="acoes" style="display: flex; justify-content: space-between;">
                                <div class="muda_status"></div>
                                <?php
                                if ($marca['statusMarca'] == "S") {
                                ?>
                                    <div class="inativo" onclick="muda_status('N', '<?php echo $marca['idMarca']; ?>')">
                                        <i class="bi bi-toggle-on"></i>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="ativo" onclick="muda_status('S', '<?php echo $marca['idMarca']; ?>')">
                                        <i class="bi bi-toggle-off"></i>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="edit" onclick="editar('<?php echo $marca['idMarca']; ?>')">
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

        
        <div class="button-container">
            <button type="button" class="btn btn-primary btn_modal" onclick="limpar_modal()" id="btn_modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar Marca</button>
        </div>  
    </div>

    
    <?php include_once('modal_marca.php'); ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
