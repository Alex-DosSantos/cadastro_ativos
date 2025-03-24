<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Opções</h1>
        <button type="button" onclick="limpar_modal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formOpcao">
          <div class="mb-3">
            <label for="descricaoOpcao" class="col-form-label">Descrição Opção:<span class="asterisco-vermelho">*</span></label>
            <input type="text" class="form-control" id="descricaoOpcao" required>
            <input type="hidden" class="form-control" id="idOpcao">
          </div>
          <div class="mb-3">
            <label for="nivelOpcao" class="col-form-label">Opção Nivel:<span class="asterisco-vermelho">*</span></label>
            <select class="form-select" id="nivelOpcao" required onchange="verificarNivel(this.value)">
              <option value="">Selecione o Nível</option>
              <?php foreach ($niveisAcesso as $nivel): ?>
                <option value="<?php echo $nivel['idNivel']; ?>"><?php echo htmlspecialchars($nivel['descricaoNivel']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Novo campo dinâmico para menu ou submenu -->
          <div class="mb-3" id="campoDinamico" style="display: none;">
            <label for="opcaoPai" class="col-form-label" id="labelOpcaoPai"></label>
            <select class="form-select" id="opcaoPai"></select>
          </div>
          <div class="mb-3">
            <label for="urlOpcao" class="col-form-label">Url Opção:</label>
            <input type="text" class="form-control" id="urlOpcao">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" onclick="limpar_modal()">Limpar</button>
        <button type="button" class="btn btn-primary salvar" id="salvarinfo">Salvar</button>
      </div>
    </div>
  </div>
</div>