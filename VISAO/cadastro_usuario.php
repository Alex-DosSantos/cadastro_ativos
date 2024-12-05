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
            border: 2px solid #800080; /* Borda roxa ao redor de toda a caixa */
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-check-label {
            font-size: 0.9rem;
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
