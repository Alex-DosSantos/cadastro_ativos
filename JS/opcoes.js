$(document).ready(function () {
  // Evento de clique no botão "Salvar"
  $(".salvar").click(function () {
      let descricaoOpcao = $("#descricaoOpcao").val();
      let idOpcao = $("#idOpcao").val();
      let nivel = $("#nivelOpcao").val();
      let url = $("#urlOpcao").val();
      let opcaoPai = $("#opcaoPai").val(); // Novo campo dinâmico

      // Validação dos campos obrigatórios
      if (descricaoOpcao === '' || nivel === '') {
          alert('Descrição e Nível são obrigatórios!');
          return false;
      }

      // Define a ação (inserir ou atualizar)
      let acao = idOpcao === "" ? 'insert' : 'update';

      // Envia os dados via AJAX
      $.ajax({
          type: 'POST',
          url: "../controle/opcoes_controller.php",
          data: {
              acao: acao,
              descricaoOpcao: descricaoOpcao,
              nivelOpcao: nivel,
              opcaoPai: opcaoPai,
              urlOpcao: url,
              idOpcao: idOpcao
              
          },
          success: function (result) {
              let resposta = JSON.parse(result);
              if (resposta.status === 'sucesso') {
                  alert(resposta.mensagem);
                  location.reload(); // Recarrega a página
              } else {
                  alert('Erro: ' + resposta.mensagem);
              }
          },
          error: function (xhr, status, error) {
              alert('Erro na requisição: ' + error);
          }
      });
  });
});

// Função para alterar o status de uma opção
function muda_status(status, idOpcao) {
  if (confirm('Tem certeza que deseja alterar o status desta opção?')) {
      $.ajax({
          type: 'POST',
          url: "../controle/opcoes_controller.php",
          data: {
              acao: 'alterar_status',
              status: status,
              idOpcao: idOpcao
          },
          success: function (result) {
              let resposta = JSON.parse(result);
              if (resposta.status === 'sucesso') {
                  alert(resposta.mensagem);
                  location.reload(); // Recarrega a página
              } else {
                  alert('Erro: ' + resposta.mensagem);
              }
          },
          error: function (xhr, status, error) {
              alert('Erro na requisição: ' + error);
          }
      });
  }
}

// Função para carregar os dados de uma opção no modal
function editar(idOpcao) {
  $.ajax({
      type: 'POST',
      url: "../controle/opcoes_controller.php",
      data: {
          acao: 'get_info',
          idOpcao: idOpcao
      },
      success: function (result) {
          let retorno = JSON.parse(result);
          if (retorno.status === 'sucesso') {
              // Preenche os campos do modal
              $("#descricaoOpcao").val(retorno.dados.descricaoOpcao);
              $("#nivelOpcao").val(retorno.dados.nivelOpcao);
              $("#urlOpcao").val(retorno.dados.urlOpcao);
              $("#idOpcao").val(retorno.dados.idOpcao);
              $("#opcaoPai").val(retorno.dados.opcaoPai);
              verificarNivel (retorno.dados.nivelOpcao,retorno.dados.idOpcaoPai);

              // Abre o modal
              $("#exampleModal").modal('show');
          } else {
              alert('Erro: ' + retorno.mensagem);
          }
      },
      error: function (xhr, status, error) {
          alert('Erro na requisição: ' + error);
      }
  });
} 
// Função para verificar o nível selecionado e carregar o campo dinâmico
function verificarNivel(idNivel,opcaoPai = false) {
    const campoDinamico = $("#campoDinamico");
    const selectOpcaoPai = $("#opcaoPai");
    const labelOpcaoPai = $("#labelOpcaoPai");
  
    // Esconde o campo dinâmico e limpa o select
    campoDinamico.hide();
    selectOpcaoPai.empty();
  
  
    // Verifica o nível selecionado
    if (idNivel == 2) { // Submenu
      labelOpcaoPai.text("Selecione o Menu:");
      buscarOpcoesPai(1,opcaoPai); // Busca opções do tipo menu (idNivel = 1)
      campoDinamico.show();
    } else if (idNivel == 3) { // Ação
      labelOpcaoPai.text("Selecione o Submenu:");
      buscarOpcoesPai(2,opcaoPai); // Busca opções do tipo submenu (idNivel = 2)
      campoDinamico.show();
    } else { // Menu
      campoDinamico.hide();
    }
  }
  
  // Função para buscar opções pai (menu ou submenu)
  function buscarOpcoesPai(idNivelPai,opcaoPai = false) {
    $.ajax({
      type: 'POST',
      url: "../controle/opcoes_controller.php",
      data: {
        acao: 'buscar_opcoes_pai',
        idNivelPai: idNivelPai
      },
      success: function (result) {
        let resposta = JSON.parse(result);
        if (resposta.status === 'sucesso') {
          const selectOpcaoPai = $("#opcaoPai");
          selectOpcaoPai.empty();
          selectOpcaoPai.append('<option value="">Selecione uma opção</option>');
          resposta.dados.forEach(opcao => {
          
            if (opcaoPai == opcao.idOpcao){
              selectOpcaoPai.append(`<option value="${opcao.idOpcao}" selected>${opcao.descricaoOpcao}</option>`);
              
            }else{
              selectOpcaoPai.append(`<option value="${opcao.idOpcao}">${opcao.descricaoOpcao}</option>`);
            }
            
          });
        } else {
          alert('Erro: ' + resposta.mensagem);
        }
      },
      error: function (xhr, status, error) {
        alert('Erro na requisição: ' + error);
      }
    });
  }

// Função para limpar os campos do modal
function limpar_modal() {
  $("#descricaoOpcao").val('');
  $("#nivelOpcao").val('');
  $("#urlOpcao").val('');
  $("#idOpcao").val('');
}