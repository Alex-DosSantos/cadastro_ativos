<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Ativo</h1>
                <button type="button" onclick="limpar_modal2()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Descrição Ativo:<span class="asterisco-vermelho">*</span></label>
                        <input type="text" class="form-control" id="ativo">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Quantidade:<span class="asterisco-vermelho">*</span></label>
                        <input type="number" class="form-control" id="quantidade">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Quantidade Min:<span class="asterisco-vermelho">*</span></label>
                        <input type="number" class="form-control" id="quantidadeMinAtivo">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Observação:<span class="asterisco-vermelho">*</span></label>
                        <input type="text" class="form-control" id="obs">
                    </div>
                    <div class="mb-3" id="quantidadeObsDiv" style="display:none;">
                        <label for="quantidadeObs" class="col-form-label">Motivo da Alteração da Quantidade:<span class="asterisco-vermelho">*</span></label>
                        <textarea class="form-control" id="quantidadeObs"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Marca:<span class="asterisco-vermelho">*</span></label>
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
                        <label for="recipient-name" class="col-form-label">Tipo:<span class="asterisco-vermelho">*</span></label>
                        <select class="form-select" id="tipo">
                            <option selected>Selecione o tipo</option>
                            <?php
                            foreach ($tipos as $tipo) {
                                echo '<option value="'. $tipo["idTipo"] .'">'.$tipo['descricaoTipo'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Imagem Ativo<span class="asterisco-vermelho">*</span></label>
                        <input class="form-control" accept="image/png, image/jpeg" type="file" id="imgAtivo">
                    </div>
                    <div class="mb-3 div_previer" style="display:none">
                        <label for="formFile" class="form-label">Imagem Preview</label>
                        <img id="img_previer" style="width: 150px; position: relative;left: 20%;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary">Limpar</button>
                <button type="button" class="btn btn-primary" id="salvarinfo">Salvar</button>
            </div>
        </div>
    </div>
</div>