<?php
include('../controle/controle_session.php');
include('../modelo/conexao.php');
include('../controle/funcoes.php');
include('cabecalho.php');
include('menu_superior.php');

// Busca os usuários com JOIN para trazer a descrição do cargo
$query = "SELECT u.*, c.descricaoCargo 
          FROM usuario u 
          LEFT JOIN cargo c ON u.idCargo = c.idCargo";
$info_db = mysqli_query($conexao, $query);




$admin = $_SESSION['admin'];
?>

    <link rel="stylesheet" href="../css/styleeess.css"> 
    <title>Lista de Usuários</title>
</head>
<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Turma</th>
                    <th scope="col">Cargo</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = mysqli_fetch_assoc($info_db)): ?>
                <tr>
                    <td>
                        <?php if ($admin == "S"): ?>
                            <a href="editar_usuario.php?id=<?php echo $user['idUsuario']; ?>">
                                <?php echo $user['nomeUsuario']; ?>
                            </a>
                        <?php else: ?>
                            <?php echo $user['nomeUsuario']; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($admin == "S"): ?>
                            <a href="editar_usuario.php?id=<?php echo $user['idUsuario']; ?>">
                                <?php echo $user['usuario']; ?>
                            </a>
                        <?php else: ?>
                            <?php echo $user['usuario']; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($admin == "S"): ?>
                            <a href="editar_usuario.php?id=<?php echo $user['idUsuario']; ?>">
                                <?php echo $user['turmaUsuario']; ?>
                            </a>
                        <?php else: ?>
                            <?php echo $user['turmaUsuario']; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($admin == "S"): ?>
                            <a href="editar_usuario.php?id=<?php echo $user['idUsuario']; ?>">
                                <?php echo $user['descricaoCargo']; ?>
                            </a>
                        <?php else: ?>
                            <?php echo $user['descricaoCargo']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>