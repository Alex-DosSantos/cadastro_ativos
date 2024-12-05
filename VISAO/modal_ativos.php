<?php


?>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Ativo</h1>
        <button type="button" onclick="limpar_modal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Descrição Ativo:</label>
            <input type="text" class="form-control" id="ativo">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Quantidade:</label>
            <input type="number" class="form-control" id="quantidade">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Observação:</label>
            <input type="text" class="form-control" id="obs">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Marca:</label>
          <select class="form-select" id="marca">
  <option selected>Selecione a marca</option>
  <?php
    foreach ($marcas as $marca) {
      echo '<option value="'. $marca["idMarca"] .'">'.$marca['descricaoMarca'].'</option>';
    }
     ?>
</select>  
</div>
<div class="mb-3">
          <label for="recipient-name" class="col-form-label">Tipo:</label>
          <select class="form-select" id="tipo">
  <option selected>Selecione o tipo</option>
  <?php
  foreach ($tipos as $tipo) {
      echo '<option value="'. $tipo["idTipo"] .'">'.$tipo['descricaoTipo'].'</option>';
    }
     ?>
</select>  
</div>
        
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" >Limpar</button>
        <button type="button" class="btn btn-primary" id="salvarinfo">Salvar</button>
        
      </div>
      </form>
    </div>
  </div>
</div>