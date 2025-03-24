<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado (defina sua própria lógica de login)
if (@$_SESSION['controle_login'] == true || @$_SESSION['login_ok'] == true) {
    $is_logged_in = true;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Navegação</title>

    <!-- Fonte do Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

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
            top: 10px;
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
    </style>
</head>

<body>

    <!-- Barra superior com a logo e menu -->
    <header>
        <!-- Logo do Senac -->
        <img src="https://api.senacrs.com.br/bff/site-senac/v1/file/078f143692e591ec20623efea089cdf3d19a24.png" alt="Logo Senac" class="logo">

        <!-- Menu de navegação -->
        <nav>
            <ul>
                <li><a href="#" class="usuario-link">HOME</a>
                    <ul class="submenu">
                        <li><a href="visao/cadastro_usuario.php">Cadastrar Usuário</a></li>
                        <li><a href="visao/login.php">Login Usuário</a></li>
                        <li><a href="visao/listar_usuario.php">Usuários</a></li>
                        <li><a href="visao/opcoes.php">Opções</a></li>
                    </ul>
                </li>
                <li><a class="usuario-link" href="visao/ativos.php">ATIVOS</a>
                    <ul class="submenu">
                        <li><a href="visao/marcas.php">Cadastrar Marcas</a></li>
                        <li><a href="visao/Tipos.php">Cadastrar Tipos</a></li>
                    </ul>
                </li>
                <li><a href="visao/movimentacao.php">MOVIMENTAÇÕES</a></li>
                <li><a href="visao/relatorio.php">RELATORIOS</a></li>
                <li><a href="visao/busca_prod_ml.php">REPOR</a>
                </li>
            </ul>
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

</body>

</html>