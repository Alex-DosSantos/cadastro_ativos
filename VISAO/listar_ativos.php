<?php
include('../controle/controle_session.php');
include('../modelo/conexao.php');
include('../controle/funcoes.php');

$info_db = buscar_info_bd($conexao,'ativos');

include('cabecalho.php');
?>


<body>
    <div class = "container">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Descrição</th>
      <th scope="col">Marca</th>
      <th scope="col">Tipo</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($info_db as $user) {
?>
    <tr>
     <td><a href="ativos_controller.php?id=<?php echo $user ['idUsuario'];?>"> <?php echo $user ['descricaoAtivo'];?> </a> </td>
     <td><a href="ativos_controller.php?id=<?php echo $user ['idUsuario'];?>"> <?php echo $user ['idMarca'];?> </a> </td>
     <td><a href="ativos_controller.php?id=<?php echo $user ['idUsuario'];?>"> <?php echo $user ['idTipo'];?> </a> </td>
    </tr>

 <?php   
}
?>


  </tbody>
</table>
    </div>
</body>
</html>