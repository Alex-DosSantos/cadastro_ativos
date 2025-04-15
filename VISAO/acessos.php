<?php
//includes (baco de dados funçoes basicas e controle de sessao)
include('../modelo/conexao.php');
include_once('../controle/controle_session.php');
include_once('../controle/funcoes.php');
//busca opçao com o nivel 1
$opcoes = buscar_info_bd($conexao, 'opcoes_menu', 'nivelOpcao',  '1');
//niveis de acesso disponviel
$niveisAcesso = buscar_info_bd($conexao, 'nivel_acesso');
// busca o cargo do usuario 
$cargoUser = buscar_info_bd($conexao, 'cargo');
foreach($niveisAcesso as $nivel){
  $array_nivel[$nivel['idNivel']] = $nivel['descricaoNivel'];
}

$title = "Opções"; // Título da página
$novoArr = []; // armazena  informaçoes  opcao principal menu
foreach ($opcoes as $row) {
  $novoArr[$row['idOpcao']]['DESCR_OPCAO'] = $row['descricaoOpcao'];
  $novoArr[$row['idOpcao']]['NIVEL_OPCAO'] = $row['nivelOpcao'];
  $novoArr[$row['idOpcao']]['URL_OPCAO'] = $row['urlOpcao'];
  $novoArr[$row['idOpcao']]['STATUS_OPCAO'] = $row['statusOpcao'];
  $novoArr[$row['idOpcao']]['ID_OPCAO_PAI'] = $row['idOpcaoPai'];
  $novoArr[$row['idOpcao']]['DESCR_NIVEL'] = $array_nivel [$row['nivelOpcao']];
   
  $opcoesSub = buscar_info_bd($conexao, 'opcoes_menu', 'idOpcaoPai', $row['idOpcao']);
// armazena  informaçoes  opcao submenu
  foreach ($opcoesSub as $sub) {
    $novoArr[$sub['idOpcao']]['DESCR_OPCAO'] = $sub['descricaoOpcao'];
    $novoArr[$sub['idOpcao']]['NIVEL_OPCAO'] = $sub['nivelOpcao'];
    $novoArr[$sub['idOpcao']]['URL_OPCAO'] = $sub['urlOpcao'];
    $novoArr[$sub['idOpcao']]['STATUS_OPCAO'] = $sub['statusOpcao'];
    $novoArr[$sub['idOpcao']]['ID_OPCAO_PAI'] = $sub['idOpcaoPai'];
    $novoArr[$sub['idOpcao']]['DESCR_NIVEL'] = $array_nivel [$sub['nivelOpcao']];
    $opcoesOp = buscar_info_bd($conexao, 'opcoes_menu', 'idOpcaoPai', $sub['idOpcao']);
// armazena  informaçoes  opcao açoes (descartadas temporariamente)
    foreach ($opcoesOp as $opcao) {
      $novoArr[$opcao['idOpcao']]['DESCR_OPCAO'] = $opcao['descricaoOpcao'];
      $novoArr[$opcao['idOpcao']]['NIVEL_OPCAO'] = $opcao['nivelOpcao'];
      $novoArr[$opcao['idOpcao']]['URL_OPCAO'] = $opcao['urlOpcao'];
      $novoArr[$opcao['idOpcao']]['STATUS_OPCAO'] = $opcao['statusOpcao'];
      $novoArr[$opcao['idOpcao']]['ID_OPCAO_PAI'] = $opcao['idOpcaoPai'];
      $novoArr[$opcao['idOpcao']]['DESCR_NIVEL'] = $array_nivel [$opcao['nivelOpcao']];
    }
  }
}

include('menu_superior.php'); // Inclui o menu superior
?>
<div class="container"> <!-- visivel -->
    <h1 class="titulo-acessos">Acessos</h1>
    
</div>
<script src="../js/acessos.js"></script> <!-- lincado com js-->
<link rel="stylesheet" href="../css/stylees2acess.css">

<body>
<div class="container">
        <div class="row">
            <div class="col-md-6">
            <label for="cargo" class="col-form-label">Cargo:<span class="asterisco-vermelho">*</span></label>
            <select class="form-select" id="cargo" onchange="busca_acesso()" name="cargo" >
              <option value="">Selecione o Cargo</option>
              <?php foreach ($cargoUser as $cargo): ?>
                <option value="<?php echo $cargo['idCargo']; ?>" >
                    <?php echo htmlspecialchars($cargo['descricaoCargo']); ?>
                </option>
              <?php endforeach;?>
            </select>
          </div>
      </div>
      <?php // listagem hierarquica com check box
                foreach($novoArr as $idOpcao => $opcao){
                  
                ?>
                <div class="row">
                <?php
               $nivel = $opcao ['NIVEL_OPCAO'];
                if ($nivel == 1) {
            $padding = '';
          } else if ($nivel == 2) {
            $padding = 'padding-left:30px;';
          } else if ($nivel = 3) {
            $padding = 'padding-left:45px;';
          };
          ?>
          <div class = "linha_opcao" style="<?php echo $padding ?>">
          <div class="input-group mb-3"><!-- selecionar/deselecionar check box -->
  <div class="input-group-text">
    <input class="form-check-input mt-0 check <?php echo $idOpcao; ?>" type="checkbox" value="<?php echo $idOpcao; ?>" aria-label="Checkbox for following text input">
  </div>
  <?php echo $opcao['DESCR_OPCAO'];?>
</div>
          
          </div>
                    
                </div>
                <?php    
                }              
              ?>     
<button type="button" class="btn btn-success salvarAcesso">Salvar</button> <!-- salva no banco -->
              </div>

</body>