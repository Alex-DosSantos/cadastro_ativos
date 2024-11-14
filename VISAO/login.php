<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos para a caixa de login */
        .login-container {
            background-color: rgba(120, 120, 120, 0.8); /* Fundo cinza semitransparente */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            margin: 0 auto;
            position: relative;
            color: white; /* Cor da fonte para branco */
        }

        /* Fundo de galaxia */
        body {
            background: url('https://www.gifcen.com/wp-content/uploads/2022/04/wallpaper-gif-4.gif') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white; /* Cor da fonte para branco */
        }

        /* Cor do botão personalizada (Púrpura) */
        .btn-purple {
            background-color: #800080;  /* Cor púrpura */
            border-color: #800080;      /* Bordas púrpura */
            color: white;               /* Texto do botão em branco */
        }

        .btn-purple:hover {
            background-color: #750bb3;  /* Tom mais escuro de púrpura */
            border-color: #750bb3;      /* Bordas mais escuras */
        }

        /* Estilos para o texto de ajuda */
        .form-text {
            font-size: 0.85rem;
        }

        /* Estilo para as caixas de digitação (inputs) */
        .form-control {
            background-color: #555;  /* Cor de fundo cinza escuro */
            color: white;            /* Texto em branco */
            border: 1px solid #444; /* Cor da borda um pouco mais clara que o fundo */
        }

        .form-control:focus {
            background-color: #666; /* Cor de fundo mais clara quando o campo é focado */
            border-color: #800080;  /* Cor da borda roxa quando o campo é focado */
        }

        h1 {
            text-align: center;
            color: white; /* Cor do título em branco */
        }
    </style>
</head>
<body>
    <form action="../controle/controle_login.php" method="post">
        <div class="login-container">
            <h1>Login</h1>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" required aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Não compartilhe suas informações</div>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" class="form-control" required id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-purple w-100">Entrar</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
