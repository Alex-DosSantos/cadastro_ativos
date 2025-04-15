<button type="button" class="btn btn-primary btn_modal"  id="btn_modal_detalhe" data-bs-toggle="modal" data-bs-target="#modal_detalhe"style='display:none'></button>
<div class="modal fade" id="modal_detalhe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Informações ativos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Descrição Ativo:<span class="asterisco-vermelho"></span></label>
                        <label id="ativo_detalhe"></label>
                        
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Quantidade:</label>
                        <label id="quantidade_detalhe"></label>

                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Quantidade Min:</label>
                        <label id="quantidadeMinAtivo_detalhe"></label>
                        
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Observação:</label>
                        <label id="obs_detalhe"></label>
                        
                    </div>
                    <div class="mb-3" id="quantidadeObsDiv" style="display:none;">
                        <label for="quantidadeObs" class="col-form-label">Motivo da Alteração da Quantidade:<span class="asterisco-vermelho"></span></label>
                        <textarea class="form-control" id="quantidadeObs"></textarea>
                  
                    </div>
                    <div class="mb-3 div_previer" style="display:none">
                        <label for="formFile" class="form-label">Imagem Preview</label>
                        <img id="img_previer_detalhe" style="width: 150px; position: relative;left: 20%;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>