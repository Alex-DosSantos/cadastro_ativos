<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Senac ativos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
    
    /* LINK DE LOGIN */
    .login-link {
        text-align: center;
        margin-top: 20px;
        color: var(--senac-blue);
    }
    
    .login-link a {
        color: var(--senac-orange);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .login-link a:hover {
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
    <div class="container">
        <div class="login-container">
            <h1>CRIE SUA CONTA</h1>
            <form action="../controle/cadastrar_usuario_controle.php" method="post">
                <div class="mb-3">
                    <label for="nome">Nome*</label>
                    <input type="text" class="form-control" name="nome" id="nome" required placeholder="Seu nome completo">
                </div>
                <div class="mb-3">
                    <label for="usuario">Usuario*</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" required placeholder="Seu usuario">
                </div>
                <div class="mb-3">
                    <label for="email">Endereço de email*</label>
                    <input type="email" class="form-control" name="email" id="email" required aria-describedby="emailHelp" placeholder="Seu email">
                </div>
                <div class="mb-3">
                    <label for="senha">Senha*</label>
                    <input type="password" class="form-control" name="senha" id="senha" required 
                        placeholder="Senha" 
                        pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,10}$" 
                        title="A senha deve conter de 6 a 10 caracteres, com pelo menos uma letra e um número.">
                </div>
                <div class="mb-3">
                    <label for="turma">Turma*</label>
                    <input type="text" class="form-control" name="turma" id="turma" required placeholder="Sua turma">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Aceitar termos</label>
                    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar suas informações, com ninguém.</small>
                </div>
                <button type="submit" class="btn btn-blue w-100" style="background:orange;">Enviar</button>
                <div class="login-link">
                    
                    <p>Possui login? <a href="../visao/login.php">Faça login aqui</a></p>
                </div>
            </form>
        </div>        
    </div>
  </body>
</html>