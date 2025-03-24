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
             /* Estilos globais */
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

        /* Checkbox personalizado */
        .form-check-input {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .form-check-input:checked {
            background-color: #800080;
            border-color: #800080;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
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
                <button type="submit" class="btn btn-purple w-100">Enviar</button>
            </form>
        </div>        
    </div>
  </body>
</html>
