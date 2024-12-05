$(document).ready(function(){
    $("#salvarinfo").click(function(){
        
      let descricao_ativo = $("#ativo").val();
      let quantidade = $("#quantidade").val();
      let marca = $("#marca").val();
      let tipo = $("#tipo").val();
      let obs = $("#obs").val();
      let idAtivo = $("#idAtivo").val();

      if (idAtivo == ""){
        acao='inserir';
        } else {
        acao='update';
      }
      //alert(descricao_ativo);
      
        $.ajax({
            type:'POST',
            url:"../controle/ativos_controller.php",
            data:{
                    acao:acao,
                    idAtivo:idAtivo,             
                    ativo:descricao_ativo,
                    quantidade:quantidade,
                    marca:marca,
                    tipo:tipo,
                    obs:obs,
                    idAtivo:idAtivo


            },
             success: function(result){
                alert(result);
                location.reload();
          
        }});
      });
    });
  
function muda_status(status,idAtivo) {
  $.ajax({
    type:'POST',
    url:"../controle/ativos_controller.php",
    data:{
            acao:'alterar_status',
            status:status,
            idAtivo:idAtivo
    },
     success: function(result){
        alert(result);
        location.reload();
  
}
  });
}
function editar (idAtivo) {
  $('#idAtivo').val(idAtivo);
  $.ajax({
    type:'POST',
    url:"../controle/ativos_controller.php",
    data:{
            acao:'get_info',
            
            idAtivo:idAtivo
    },
     success: function(result){
       retorno=JSON.parse(result)
       $(".btn_modal").click();
       
       $("#ativo").val(retorno[0]['descricaoAtivo']);
      $("#quantidade").val(retorno[0]['quantidadeAtivo']);
      $("#marca").val(retorno[0]['idMarca']);
       $("#tipo").val(retorno[0]['idTipo']);
       $("#obs").val(retorno[0]['observacaoAtivo']);
       

        
  
}
  });
}

function limpar_modal(){
  $("#ativo").val('');
      $("#quantidade").val('');
      $("#marca").val('');
       $("#tipo").val('');
       $("#obs").val('');
}
