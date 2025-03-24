<?php
class opcoes{
    public function insert($conexao, $valor1, $valor2, $valor3){
        $query = "
 insert into opcoes_menu (
 descricaoOpcao,
 datacadastroopcao,
 idUsuario
 ) values (
 '".$acao."',
 'S',
NOW(),
'".$user."'
 )
";
    }
    public function alterar_status($conexao, $idOpcao) {

    }
    public function get_info($conexao, $idOpcao) {
        
    }
    public function update($conexao, $valor1, $valor2, $valor3){
}
}
?>