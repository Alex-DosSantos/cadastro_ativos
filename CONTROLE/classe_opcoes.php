<?php
class Opcoes {
    // Método para inserir uma nova opção
    public function insert($conexao, $descricaoOpcao, $url, $nivel, $user, $opcaoPai) {
        $query = "
            INSERT INTO opcoes_menu (
                descricaoOpcao, urlOpcao, nivelOpcao, idUsuario, datacadastroopcao, idOpcaoPai
            ) VALUES (
                '$descricaoOpcao', '$url', '$nivel', '$user', NOW() , '$opcaoPai'
            )
        ";
        if (!mysqli_query($conexao, $query)) {
            throw new Exception("Erro ao inserir opção: " . mysqli_error($conexao));
        }
    }

    // Método para atualizar uma opção
    public function update($conexao, $idOpcao, $descricaoOpcao, $url, $nivel, $user, $opcaoPai) {
        $query = "
            UPDATE opcoes_menu
            SET descricaoOpcao = '$descricaoOpcao',
                urlOpcao = '$url',
                nivelOpcao = '$nivel',
                idOpcaoPai = '$opcaoPai',
                idUsuario = '$user'
            WHERE idOpcao = $idOpcao
        ";
        if (!mysqli_query($conexao, $query)) {
            throw new Exception("Erro ao atualizar opção: " . mysqli_error($conexao));
        }
    }

    // Método para alterar o status de uma opção
    public function alterar_status($conexao, $idOpcao) {
        $query = "
            UPDATE opcoes_menu
            SET status = IF(status = 'A', 'I', 'A')
            WHERE idOpcao = $idOpcao
        ";
        if (!mysqli_query($conexao, $query)) {
            throw new Exception("Erro ao alterar status: " . mysqli_error($conexao));
        }
    }

    // Método para obter informações de uma opção
    public function get_info($conexao, $idOpcao) {
        $query = "SELECT * FROM opcoes_menu WHERE idOpcao = $idOpcao";
        $resultado = mysqli_query($conexao, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            return mysqli_fetch_assoc($resultado);
        } else {
            throw new Exception("Opção não encontrada.");
        }
    }
}
?>