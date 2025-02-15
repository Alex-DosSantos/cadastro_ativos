$(document).ready(function () {
  $("#salvarinfo").click(function () {

    let descricao_ativo = $("#ativo").val();
    let quantidade = $("#quantidade").val();
    let quantidadeMinAtivo = $("#quantidadeMinAtivo").val();
    let marca = $("#marca").val();
    let tipo = $("#tipo").val();
    let obs = $("#obs").val();
    let idAtivo = $("#idAtivo").val();

    let imgAtivo = $("#imgAtivo");
    let img = imgAtivo[0].files[0];

    if (idAtivo == "") {
      acao = 'inserir';
    } else {
      acao = 'update';
    }
    var formData = new FormData();
    formData.append('acao', acao);
    formData.append('ativo', descricao_ativo);
    formData.append('marca', marca);
    formData.append('tipo', tipo);
    formData.append('quantidade', quantidade);
    formData.append('quantidadeMinAtivo', quantidadeMinAtivo);
    formData.append('obs', obs);
    formData.append('idAtivo', idAtivo);
    formData.append('img', img);


    //alert(descricao_ativo);

    $.ajax({
      type: 'POST',
      url: "../controle/ativos_controller.php",
      data: formData,
      processData: false,
      contentType: false,



      success: function (result) {
        alert(result);
        //location.reload();

      }
    });
  });
});

function muda_status(status, idAtivo) {
  $.ajax({
    type: 'POST',
    url: "../controle/ativos_controller.php",
    data: {
      acao: 'alterar_status',
      status: status,
      idAtivo: idAtivo
    },
    success: function (result) {
      alert(result);
      location.reload();

    }
  });
}
function editar(idAtivo) {
  $('#idAtivo').val(idAtivo);
  $.ajax({
    type: 'POST',
    url: "../controle/ativos_controller.php",
    data: {
      acao: 'get_info',

      idAtivo: idAtivo
    },
    success: function (result) {
      retorno = JSON.parse(result)
      $(".btn_modal").click();

      $("#ativo").val(retorno[0]['descricaoAtivo']);
      $("#quantidade").val(retorno[0]['quantidadeAtivo']);
      $("#quantidadeMinAtivo").val(retorno[0]['quantidadeMinAtivo']);
      $("#marca").val(retorno[0]['idMarca']);
      $("#tipo").val(retorno[0]['idTipo']);
      $("#obs").val(retorno[0]['observacaoAtivo']);
      if (retorno[0]['urlImagem'] != "") {
        
        $("#img_previer").attr('src', window.location.protocol + "//" + window.location.host + '' + retorno[0]['urlImagem']);
        $(".div_previer").attr('style', 'display:block');
      } else {
        $(".div_previer").attr('style', 'display:none');
      }



    }
  });
}

function limpar_modal() {
  $("#ativo").val('');
  $("#quantidade").val('');
  $("#quantidadeMinAtivo").val('');
  $("#marca").val('');
  $("#tipo").val('');
  $("#obs").val('');
  
}
function limpar_modal2() {
  $("#idAtivo").val('');
  $("#ativo").val('');
  $("#quantidade").val('');
  $("#quantidadeMinAtivo").val('');
  $("#marca").val('');
  $("#tipo").val('');
  $("#obs").val('');
  $(".div_previer").attr('style', 'display:none');
}