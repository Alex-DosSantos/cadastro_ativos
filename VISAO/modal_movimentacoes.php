
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Movimentação</h5>
        <button type="button" onclick="limpar_modal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form_movimentacao">
          <div class="mb-3">
            <label for="idAtivo" class="col-form-label">Ativo :<span class="asterisco-vermelho">*</span></label>
            <select class="form-select" id="idAtivo" required>
              <option selected>Selecione o Ativo</option>
              <?php
                // Preenche a lista de ativos com base no banco de dados
                $ativos_result = mysqli_query($conexao, "SELECT * FROM ativos");
                while ($ativo = mysqli_fetch_assoc($ativos_result)) {
                    echo "<option value='{$ativo['idAtivo']}'>{$ativo['descricaoAtivo']}</option>";
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="descricaoMovimentacao" class="col-form-label">Descrição da Movimentação :</label>
            <input type="text" class="form-control" id="descricaoMovimentacao" required>
          </div>
          <div class="mb-3">
            <label for="quantidadeMov" class="col-form-label">Quantidade Movimentada :<span class="asterisco-vermelho">*</span></label>
            <input type="number" class="form-control" id="quantidadeMov" required>
          </div>
          <div class="mb-3">
            <label for="tipoMovimentacao" class="col-form-label">Tipo de Movimentação :<span class="asterisco-vermelho">*</span></label>
            <select class="form-select" id="tipoMovimentacao" required>
            <option value="">Selecione</option>
              <option value="entrada">Entrada</option>
              <option value="realocar">Realocar</option>
              <option value="saida">Saída</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="localOrigem" class="col-form-label">Local de Origem:<span class="asterisco-vermelho">*</span></label>
            <input type="text" class="form-control" id="localOrigem" required>
          </div>
          <div class="mb-3">
            <label for="localDestino" class="col-form-label">Local de Destino:<span class="asterisco-vermelho">*</span></label>
            <input type="text" class="form-control" id="localDestino" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="salvarMovimentacao()">Salvar</button>
      </div>
    </div>
  </div>
</div>