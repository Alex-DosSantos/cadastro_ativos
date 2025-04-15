$(document).ready(function () {
  // Evento de clique no botão de salvar
  $("#salvarinfo").click(function () {
    let descricao_ativo = $("#ativo").val();
    let quantidade = $("#quantidade").val();
    let quantidadeMinAtivo = $("#quantidadeMinAtivo").val();
    let marca = $("#marca").val();
    let tipo = $("#tipo").val();
    let obs = $("#obs").val();
    let idAtivo = $("#idAtivo").val();
    let quantidadeObs = $("#quantidadeObs").val(); // Novo campo: motivo da alteração

    let imgAtivo = $("#imgAtivo");
    let img = imgAtivo[0].files[0];

    // Validação dos campos obrigatórios
    if (descricao_ativo == '' || quantidade == '' || marca == '' || tipo == '' || obs == '') {
      alert('Todos os campos são obrigatórios!');
      return false;
    }

    // Verifica se a quantidade foi alterada e se o motivo foi preenchido
    if (quantidade !== quantidadeOriginal && quantidadeObs === "") {
      alert("Por favor, informe o motivo da alteração da quantidade.");
      return false;
    }

    // Define a ação (inserir ou atualizar)
    if (idAtivo == "") {
      acao = 'inserir';
    } else {
      acao = 'update';
    }

    // Cria o FormData para enviar os dados
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
    formData.append('quantidadeObs', quantidadeObs); // Adiciona o motivo da alteração

    // Envia os dados via AJAX
    $.ajax({
      type: 'POST',
      url: "../controle/ativos_controller.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (result) {
        alert(result);
        location.reload();
      }
    });
  });

  // Mostrar a div do motivo quando a quantidade for alterada
  $("#quantidade").on('change', function() {
    $("#quantidadeObsDiv").show(); // Mostra a div do motivo
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
      retorno = JSON.parse(result);
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

      // Armazena a quantidade original para comparação
      quantidadeOriginal = retorno[0]['quantidadeAtivo'];
    }
  });
}
function busca_detalhe (idAtivo) {
  $('#idAtivo').val(idAtivo);
  $.ajax({
    type: 'POST',
    url: "../controle/ativos_controller.php",
    data: {
      acao: 'busca_detalhe',
      idAtivo: idAtivo
    },
    success: function (result) {
      retorno = JSON.parse(result);
      $("#btn_modal_detalhe").click();

      $("#ativo_detalhe").html(retorno[0]['descricaoAtivo']);
      $("#quantidade_detalhe").html(retorno[0]['quantidadeAtivo']);
      $("#quantidadeMinAtivo_detalhe").html(retorno[0]['quantidadeMinAtivo']);
      $("#marca_detalhe").html(retorno[0]['idMarca']);
      $("#tipo_detalhe").html(retorno[0]['idTipo']);
      $("#obs_detalhe").html(retorno[0]['observacaoAtivo']);
      if (retorno[0]['urlImagem'] != "") {
        $("#img_previer_detalhe").attr('src', window.location.protocol + "//" + window.location.host + '' + retorno[0]['urlImagem']);
        $(".div_previer").attr('style', 'display:block');
      } else {
        $(".div_previer").attr('style', 'display:none');
      }

      // Armazena a quantidade original para comparação
      
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
  $("#quantidadeObsDiv").hide(); // Oculta a div do motivo ao limpar o modal
  $("#quantidadeObs").val(''); // Limpa o campo do motivo
}

// Função para redirecionar para a página de busca com os parâmetros de descrição e marca
function buscarAtivo(idAtivo) {
  window.location.href = `busca_prod_ml.php?idAtivo=` + idAtivo;
}

// Função para alternar a visibilidade das informações adicionais
function toggleInfo(button) {
  const row = button.closest('tr');
  $(row).find('.observacao, .data-cadastro, .usuario-cadastro').toggleClass('hidden');
  $('th.observacao-header, th.data-cadastro-header, th.usuario-cadastro-header').toggleClass('hidden');
  const icon = button.querySelector('i');
  if (icon.classList.contains('bi-eye')) {
    icon.classList.remove('bi-eye');
    icon.classList.add('bi-eye-slash');
  } else {
    icon.classList.remove('bi-eye-slash');
    icon.classList.add('bi-eye');
  }
}