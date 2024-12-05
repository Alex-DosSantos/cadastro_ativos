<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado (defina sua própria lógica de login)
$is_logged_in = isset($_SESSION['usuario_logado']); // A variável de sessão 'usuario_logado' define o estado de login

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
            background-color: black;
            padding: 10px 0;
            position: relative;
        }

        /* Logo no canto superior esquerdo */
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            height: 50px;
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
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Efeito de hover */
        nav ul li a:hover {
            background-color: #575757;
            transform: scale(1.1);
        }

        /* Submenu */
        .submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #333;
            min-width: 200px;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .submenu li a {
            padding: 12px 16px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .submenu li a:hover {
            background-color: #575757;
            transform: scale(1.1);
        }

        .usuario-link:hover + .submenu, 
        .submenu:hover {
            display: block;
        }

        /* Caixa centralizada */
        .caixa-centralizada {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            width: 80%;
            max-width: 800px;
            margin: 100px auto;
            text-align: center;
        }

        .caixa-centralizada h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .caixa-centralizada p {
            font-size: 1.2rem;
            color: #555;
            line-height: 1.5;
        }

        /* Botão de logout */
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: orange;
            color: white;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 25px; /* Borda arredondada */
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Efeito de hover no botão de logout */
        .logout-btn:hover {
            background-color: #e68a00;
            transform: scale(1.1);
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
                        <li><a href="../visao/cadastro_usuario.php">Cadastrar Usuário</a></li>
                        <li><a href="../visao/login.php">Login Usuário</a></li>
                    </ul>
                </li>
                <li><a href="pagina1.html">ATIVOS</a></li>
                <li><a href="pagina2.html">MOVIMENTAÇÕES</a></li>
            </ul>
        </nav>

        <?php if ($is_logged_in): ?>
            <!-- Botão de logout, visível apenas se o usuário estiver logado -->
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php endif; ?>
    </header>

    <!-- Caixa centralizada com as informações -->
    <div class="caixa-centralizada">
        <h1>Bem-vindo à página de controle de ativos do Senac</h1>
        <p>Para melhor compreensão, nesta página estarão disponíveis o login e controle de usuários. Você deve acessar com sua conta em <strong>Home</strong> para ter acesso e realizar alterações ou criar um novo cadastro.</p>
        <p><strong>Caso queira apenas olhar, não será necessário fazer login.</strong></p>
    </div>

</body>
</html>