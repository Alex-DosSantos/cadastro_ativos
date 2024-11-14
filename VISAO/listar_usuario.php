<?php
include('../modelo/conexao.php');
include('../controle/funcoes.php');

$info_db = buscar_info_bd($conexao,'usuario');

include('cabecalho.php');
?>


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
     <td><a href="editar_usuario.php?id=<?php echo $user ['idUsuario'];?>"> <?php echo $user ['nomeUsuario'];?> </a> </td>
     <td><a href="editar_usuario.php?id=<?php echo $user ['idUsuario'];?>"> <?php echo $user ['usuario'];?> </a> </td>
     <td><a href="editar_usuario.php?id=<?php echo $user ['idUsuario'];?>"> <?php echo $user ['turmaUsuario'];?> </a> </td>
    </tr>

 <?php   
}
?>


  </tbody>
</table>
    </div>
</body>
</html>