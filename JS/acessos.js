$(document).ready(function () {
  $('.salvarAcesso').click(function () { // click do salvar
  inputs = document.querySelectorAll('.check');
  let array_acesso={};
  $(inputs).each(function(index,elemento){
    if (!array_acesso[index]){
      array_acesso[index] = {};
    } // verifica se ta marcado cadastra com (S) permitido
    if ($(elemento).is(":checked")){
      array_acesso[index]['idOpcao'] = $(elemento).val();
      array_acesso[index]['acessos'] = 'S';
        
       
    }else{ // se nao tiver marcado cadastra com (N) negado
      array_acesso[index]['idOpcao'] = $(elemento).val();
      array_acesso[index]['acessos'] = 'N';
    }
  });
  cargo = $('#cargo').val();
  let array_dados={};
  array_dados['acao']='gravar_acesso';
  array_dados['cargo']=cargo;
  array_dados['acessos']=array_acesso;
  console.log(array_acesso);
// envia dados via ajax pro servidor
    $.ajax({
      method : "POST",
      url: "../controle/acesso_controller.php",
      contentType : 'application/json',
      dataType : 'json',
      data : JSON.stringify(array_dados),
      success: function (result) {
        alert(result);
        location.reload();
      }
      });
    });
  });
  function busca_acesso(){
let cargo = $('#cargo').val();
$('.check').each(function (index, element){
 $(this).prop('checked',false);
});// requisiçao pra buscar 
$.ajax({
  type: 'POST',
  url: "../controle/acesso_controller.php",
  data: {
    acao: 'buscar_acesso',
    cargo: cargo
  },
  success: function (result) {
    let retorno = JSON.parse(result); // converte JSON para jS
    $(retorno).each(function (index, acesso){
      console.log(acesso)
      if(acesso.statusAcesso =='S'){
        $('.'+acesso.idOpcao).prop('checked',true);
      }else{
        $('.'+acesso.idOpcao).prop('checked',false);
      }
    });
    
  }
});
  }

  
