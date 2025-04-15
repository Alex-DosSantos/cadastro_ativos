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
    /* PALETA OFICIAL SENAC */
    :root {
        --senac-blue: #004A8D;
        --senac-orange: #F7941D;
        --senac-light-orange: #FDC180;
    }

    /* ESTILOS GLOBAIS */
    body {
        background: url('https://img.freepik.com/fotos-premium/textura-de-artesanato-azul-marinho-branco-e-laranja-cor-de-fundo-macro-de-fundo-papelao-indigo-abstrato-vintage_113767-6640.jpg') center/cover no-repeat fixed;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    /* CONTAINER SEMI-TRANSLÚCIDO SIMPLES */
    .login-container {
        background-color: rgba(255, 255, 255, 0.75); /* 75% de opacidade */
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 74, 141, 0.2);
        max-width: 450px;
        width: 90%;
        margin: 0 auto;
        border: 2px solid var(--senac-orange); /* Contorno laranja sólido */
    }

    /* TÍTULO */
    h1 {
        text-align: center;
        color: var(--senac-blue);
        font-size: 2.2rem;
        margin-bottom: 30px;
        font-weight: 700;
        position: relative;
    }

    h1::after {
        content: "";
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: var(--senac-orange);
    }

    /* CAMPOS DE FORMULÁRIO */
    .form-control {
        background-color: rgba(255, 255, 255, 0.8);
        color: var(--senac-blue);
        border: 2px solid rgba(0, 74, 141, 0.3);
        border-radius: 8px;
        padding: 12px 16px;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .form-control:focus {
        border-color: var(--senac-orange);
        box-shadow: 0 0 0 3px rgba(247, 148, 30, 0.2);
        background-color: white;
    }

    /* BOTÃO PRINCIPAL */
    .btn-senac {
        background-color: var(--senac-orange);
        color: white;
        border: none;
        padding: 14px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-senac:hover {
        background-color: #e68317;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(247, 148, 30, 0.3);
    }
    
    /* LINK DE CADASTRO */
    .register-link {
        text-align: center;
        margin-top: 20px;
        color: var(--senac-blue);
    }
    
    .register-link a {
        color: var(--senac-orange);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .register-link a:hover {
        color: #e68317;
        text-decoration: underline;
    }

    /* RESPONSIVIDADE */
    @media (max-width: 576px) {
        .login-container {
            padding: 30px 20px;
            width: 85%;
        }
        
        h1 {
            font-size: 1.8rem;
        }
    }
</style>
</head>
<body>
    <form action="../controle/controle_login.php" method="post">
        <div class="login-container">
            <h1>LOGIN</h1>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" name="user" class="form-control" id="usuario" required aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Não compartilhe suas informações</div>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha" class="form-control" required id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-purple w-100" style="background:orange;">Entrar</button>
            <div class="register-link">
                
                <p>Não tem uma conta? <a href="../visao/cadastro_usuario.php">Cadastre-se</a></p>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>