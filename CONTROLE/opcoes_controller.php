<?php
include('controle_session.php'); // Verifica a sessão do usuário
include('classe_opcoes.php'); // Inclui a classe Opcoes
include('../modelo/conexao.php'); // Inclui a conexão com o banco de dados

// Verifica se a ação foi enviada
if (!isset($_POST['acao'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Ação não especificada']);
    exit;
}

// Sanitiza e valida os dados de entrada
$acao = $_POST['acao'];
$descricaoOpcao = isset($_POST['descricaoOpcao']) ? trim($_POST['descricaoOpcao']) : null;
$url = isset($_POST['urlOpcao']) ? trim($_POST['urlOpcao']) : null;
$nivel = isset($_POST['nivelOpcao']) ? trim($_POST['nivelOpcao']) : null;
$idOpcao = isset($_POST['idOpcao']) ? (int)$_POST['idOpcao'] : null;
$opcaoPai = isset($_POST['opcaoPai']) ? (int)$_POST['opcaoPai'] : '';
$user = $_SESSION['id_user']; // Assume que o usuário está na sessão

$classeOpcoes = new Opcoes();

try {
    switch ($acao) {
        case 'insert':
            // Valida campos obrigatórios
            if (empty($descricaoOpcao) || empty($nivel)) {
                throw new Exception('Descrição e Nível são obrigatórios.');
            }

            // Insere a nova opção
            $classeOpcoes->insert($conexao, $descricaoOpcao, $url, $nivel, $user, $opcaoPai);
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Opção inserida com sucesso!']);
            break;
        
            case 'buscar_opcoes_pai':
                // Valida o ID do nível pai
                if (empty($_POST['idNivelPai'])) {
                    throw new Exception('Nível pai não informado.');
                }
            
                $idNivelPai = (int)$_POST['idNivelPai'];
                $query = "SELECT idOpcao, descricaoOpcao FROM opcoes_menu WHERE nivelOpcao = $idNivelPai";
                $resultado = mysqli_query($conexao, $query);
            
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    $dados = [];
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        $dados[] = $row;
                    }
                    echo json_encode(['status' => 'sucesso', 'dados' => $dados]);
                } else {
                    throw new Exception('Nenhuma opção encontrada para o nível selecionado.');
                }
                break;

        case 'update':
            // Valida campos obrigatórios
            if (empty($idOpcao) || empty($descricaoOpcao) || empty($nivel)) {
                throw new Exception('ID, Descrição e Nível são obrigatórios.');
            }

            // Atualiza a opção
            $classeOpcoes->update($conexao, $idOpcao, $descricaoOpcao, $url, $nivel, $user, $opcaoPai);
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Opção atualizada com sucesso!']);
            break;

        case 'alterar_status':
            // Valida o ID da opção
            if (empty($idOpcao)) {
                throw new Exception('ID da opção não informado.');
            }

            // Altera o status da opção
            $classeOpcoes->alterar_status($conexao, $idOpcao);
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Status alterado com sucesso!']);
            break;

        case 'get_info':
            // Valida o ID da opção
            if (empty($idOpcao)) {
                throw new Exception('ID da opção não informado.');
            }

            // Obtém as informações da opção
            $dados = $classeOpcoes->get_info($conexao, $idOpcao);
            echo json_encode(['status' => 'sucesso', 'dados' => $dados]);
            break;

        default:
            throw new Exception('Ação inválida.');
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => $e->getMessage()]);
}