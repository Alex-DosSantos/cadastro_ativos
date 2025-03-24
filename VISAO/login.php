<?php
session_start();

if (isset($_GET['erro']) && $_GET['erro'] == 'sem_acesso') {
    echo "<script>alert('ususario nao autenticado');</script>";
}
if (isset($_GET['error_auten']) && $_GET['error_auten'] == 's') {
    echo  "<script>alert('senha ou usuario invalido');</script>";
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
 body {
            background: url('https://www.gifcen.com/wp-content/uploads/2022/04/wallpaper-gif-4.gif') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Container de login */
        .login-container {
            background-color: rgba(0, 0, 0, 0.7); /* Fundo preto semitransparente */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            color: white;
            border: 2px solid #800080; /* Borda roxa */
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Título */
        h1 {
            text-align: center;
            color: white;
            font-size: 2rem;
            margin-bottom: 20px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* Campos de formulário */
        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            color: white; /* Texto sempre branco */
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #800080;
            box-shadow: 0 0 8px rgba(128, 0, 128, 0.5);
            color: white; /* Texto sempre branco, mesmo no foco */
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Botão personalizado */
        .btn-purple {
            background-color: #800080;
            border-color: #800080;
            color: white;
            padding: 12px;
            font-size: 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .btn-purple:hover {
            background-color: #750bb3;
            border-color: #750bb3;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(128, 0, 128, 0.4);
        }

        /* Texto de ajuda */
        .form-text {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Efeito de hover nos labels */
        label {
            transition: color 0.3s ease;
        }

        label:hover {
            color: #800080;
        }

        /* Responsividade */
        @media (max-width: 576px) {
            .login-container {
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <form action="../controle/controle_login.php" method="post">
        <div class="login-container">
            <h1>Login</h1>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" name="user" class="form-control" id="usuario" required aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Não compartilhe suas informações</div>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha" class="form-control" required id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-purple w-100">Entrar</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
