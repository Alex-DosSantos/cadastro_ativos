$(document).ready(function(){
    $(".salvar").click(function(){
        
      
      let marca = $("#marca").val();
      let idMarca = $("#idMarca").val();
      if (marca == '') {
        alert('A descrição da Marca deve ser preenchida!');
        return false;
    }
      if (idMarca == ""){
        acao='inserir';
        } else {
        acao='update';
      }
      //alert(descricao_ativo);
      
        $.ajax({
            type:'POST',
            url:"../controle/marcas_controller.php",
            data:{
                    acao:acao,      
                    marca:marca,
                    idMarca:idMarca


            },
             success: function(result){
                alert(result);
                location.reload();
          
        }});
      });
    });
  
function muda_status(status,idMarca) {
  $.ajax({
    type:'POST',
    url:"../controle/marcas_controller.php",
    data:{
            acao:'alterar_status',
            status:status,
            idMarca:idMarca
    },
     success: function(result){
        alert(result);
        location.reload();
  
}
  });
}
function editar (idMarca) {
  $('#idMarca').val(idMarca);
  $.ajax({
    type:'POST',
    url:"../controle/marcas_controller.php",
    data:{
            acao:'get_info',
            
            idMarca:idMarca
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
