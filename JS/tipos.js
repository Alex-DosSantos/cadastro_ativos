$(document).ready(function(){
    $(".salvar").click(function(){
        
      
      let tipo = $("#tipo").val();
      let idTipo = $("#idTipo").val();
      if (tipo == '') {
        alert('A descrição do tipo deve ser preenchida!');
        return false;
    }
      if (idTipo == ""){
        acao='inserir';
        } else {
        acao='update';
      }
      //alert(descricao_ativo);
      
        $.ajax({
            type:'POST',
            url:"../controle/tipos_controller.php",
            data:{
                    acao:acao,      
                    tipo:tipo,
                    idTipo:idTipo


            },
             success: function(result){
                alert(result);
                location.reload();
          
        }});
      });
    });
  
function muda_status(status,idtipo) {
  $.ajax({
    type:'POST',
    url:"../controle/tipos_controller.php",
    data:{
            acao:'alterar_status',
            status:status,
            idTipo:idTipo
    },
     success: function(result){
        alert(result);
        location.reload();
  
}
  });
}
function editar (idTipo) {
  $('#idTipo').val(idTipo);
  $.ajax({
    type:'POST',
    url:"../controle/tipos_controller.php",
    data:{
            acao:'get_info',
            
            idTipo:idTipo
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
