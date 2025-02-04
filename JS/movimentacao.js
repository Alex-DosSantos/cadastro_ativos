
function limpar_modal() {
    $("#idMovimentacao").val('');
    $("#idAtivo").val('');
    $("#descricaoMovimentacao").val('');
    $("#quantidadeMov").val('');
    $("#tipoMovimentacao").val('');
    $("#localOrigem").val('');
    $("#localDestino").val('');
    $("#dataMovimentacao").val('');

}
function salvarMovimentacao() {

    let idAtivo = $("#idAtivo").val();
    let descricaoMovimentacao = $("#descricaoMovimentacao").val();
    let quantidadeMov = $("#quantidadeMov").val();
    let tipoMovimentacao = $("#tipoMovimentacao").val();
    let localOrigem = $("#localOrigem").val();
    let localDestino = $("#localDestino").val();
    if (idAtivo == '' || quantidadeMov == '' || tipoMovimentacao == '') {
        alert('Todos os campos são obrigatórios!');
        return false;
    }


    $.ajax({
        type: 'POST',
        url: "../controle/mov_controller.php",
        data: {


            idAtivo: idAtivo,
            descricaoMovimentacao: descricaoMovimentacao,
            quantidadeMov: quantidadeMov,
            tipoMovimentacao: tipoMovimentacao,
            localOrigem: localOrigem,
            localDestino: localDestino,

        },
        success: function (result) {
            alert(result);
            if (result == 'sucesso') {
                location.reload();
            }
        }
    });
}