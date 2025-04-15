<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado (defina sua própria lógica de login)
if (@$_SESSION['controle_login'] == true || @$_SESSION['login_ok'] == true) {
    $is_logged_in = true;
}

include_once('modelo/conexao.php');
$cargo = $_SESSION['idCargo'] ?? null;

$sqlMenu = "
    select 
    idOpcao,
    descricaoOpcao,
    urlOpcao
    from 
    opcoes_menu O 
    where
    nivelOpcao = 1
    and statusOpcao = 'S'
    and idOpcao in(
    select idOpcao from acesso A where A.idOpcao = O.idOpcao and statusAcesso = 'S' and idCargo = $cargo
) ";

$result = mysqli_query($conexao, $sqlMenu) or die(false);
$acessos_menu = $result->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Navegação</title>

    <!-- Fonte do Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Estilo geral do corpo */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            background-image: url('https://api.senacrs.com.br/bff/site-senac/v1/file/078f14348e634ca8e027c1fd4ceef9b63a9eb2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        /* Estilo para a barra superior preta */
        header {
            background-color: rgba(0, 0, 0, 0.9);
            padding: 10px 0;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* Logo no canto superior esquerdo */
        .logo {
            position: absolute;
            top: 1px;
            left: 20px;
            height: 50px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.1);
        }

        /* Estilo da barra de navegação */
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        nav ul li {
            display: inline-block;
            position: relative;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            display: block;
            font-weight: 600;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.3s ease, color 0.3s ease;
        }

        /* Efeito de hover */
        nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-5px);
            
        }

        /* Submenu */
        .submenu {
            display: none;
            position: absolute;
            top: 90%;
            left: 0;
            background-color: rgba(0, 0, 0, 0.9);
            min-width: 200px;
            list-style-type: none;
            padding: 0;
            margin: 0;
            border-radius: 5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .submenu li a {
            padding: 12px 16px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease, color 0.3s ease;
        }

        .submenu li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(10px);
            
        }

        .usuario-link:hover+.submenu,
        .submenu:hover {
            display: block;
        }

        /* Caixa centralizada */
        .caixa-centralizada {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            width: 80%;
            max-width: 800px;
            margin: 100px auto;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .caixa-centralizada h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
            animation: fadeIn 1s ease;
        }

        .caixa-centralizada p {
            font-size: 1.2rem;
            color: #555;
            line-height: 1.5;
            animation: fadeIn 1.5s ease;
        }

        /* Botão de logout */
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            background-color: orange;
            color: white;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Efeito de hover no botão de logout */
        .logout-btn:hover {
            background-color: #e68a00;
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        /* Estilos para o menu responsivo */
        .bg-primary {
            --bs-bg-opacity: 1;
            background-color: rgb(0 0 0) !important;
        }

        .usuario-link {
            font-weight: bold;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        #navbarNavDropdown {
            justify-content: center;
        }

        @media (max-width: 991.98px) {
            .dropdown-menu {
                background-color: transparent;
                border: none;
            }

            .navbar-toggler {
                position: relative;
                left: -7rem;
            }

            .dropdown-item {
                padding-left: 2rem;
                color: rgba(255, 255, 255, 0.75);
            }

            .dropdown-item:hover {
                color: white;
                background-color: transparent;
            }
        }
    </style>
</head>

<body>

    <!-- Barra superior com a logo e menu -->
    <header>
        <!-- Menu de navegação -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">
                    <img src="https://www.sc.senac.br/cursotecnico/images/logo-ext-white.png" alt="Logo Senac" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <?php
                        foreach ($acessos_menu as $acesso) {
                            $sqlSubMenu = "
                                select 
                                idOpcao,
                                descricaoOpcao,
                                urlOpcao
                                from 
                                opcoes_menu O 
                                where
                                idOpcaoPai = '" . $acesso['idOpcao'] . "'
                                and statusOpcao = 'S'
                                and nivelOpcao = 2
                                and idOpcao in(
                                select idOpcao from acesso A where A.idOpcao = O.idOpcao and statusAcesso = 'S' and idCargo = $cargo
                            )";
                            $resultSubMenu = mysqli_query($conexao, $sqlSubMenu) or die(false);
                            $acessos_submenu = $resultSubMenu->fetch_all(MYSQLI_ASSOC);
                            if (count($acessos_submenu) > 0) { 
                        ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle usuario-link" href="../index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo $acesso['descricaoOpcao'] ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        foreach ($acessos_submenu as $subMenu) {
                                            echo '<li><a class="dropdown-item" href="visao/' . $subMenu['urlOpcao'] . '">' . $subMenu['descricaoOpcao'] . '</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </li>
                        <?php
                            } else {
                                echo ' <li class="nav-item">
                                    <a class="nav-link" href="visao/' . $acesso['urlOpcao'] . '">' . $acesso['descricaoOpcao'] . '</a>
                                </li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?php if (isset($is_logged_in)): ?>
            <!-- Botão de logout, visível apenas se o usuário estiver logado -->
            <a href="controle/logout.php" class="logout-btn">Logout</a>
        <?php endif; ?>
    </header>

    <!-- Caixa centralizada com as informações -->
    <div class="caixa-centralizada">
        <h1>Bem-vindo à página de controle de ativos do Senac</h1>
        <p>Para melhor compreensão, nesta página estarão disponíveis o login e controle de usuários. Você deve acessar com sua conta em <strong>Home</strong> para ter acesso e realizar alterações ou criar um novo cadastro.</p>
        <p><strong>Caso queira apenas olhar, será necessário fazer login.</strong></p>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>