<?php
include('../controle/controle_session.php');
include('../modelo/conexao.php');
include('../controle/funcoes.php');
include ('menu_superior.php');
$info_db = buscar_info_bd($conexao,'usuario');

include('cabecalho.php');
$admin = $_SESSION['admin'];
?>
<head>
<link rel="stylesheet" href="../css/styleeess.css"> 
</head>

<body>
    <div class = "container">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Usuario</th>
      <th scope="col">Turma</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($info_db as $user) {
?>
    <tr>
     <td><?php if ($admin == "S"){?><a href="editar_usuario.php?id=<?php echo $user ['idUsuario'];?>"> <?php echo $user ['nomeUsuario'];?> </a> <?php }else{echo $user['nomeUsuario'];} ?> </td>
     <td><?php if ($admin == "S"){?><a href="editar_usuario.php?id=<?php echo $user ['idUsuario'];?>"> <?php echo $user ['usuario'];?> </a> <?php }else{echo $user['usuario'];} ?> </td>
     <td><?php if ($admin == "S"){?><a href="editar_usuario.php?id=<?php echo $user ['idUsuario'];?>"> <?php echo $user ['turmaUsuario'];?> </a> <?php }else{echo $user['turmaUsuario'];} ?> </td>
    </tr>

 <?php   
}
?>


  </tbody>
</table>
    </div>
</body>
</html>