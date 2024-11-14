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


 <head>
<body>
<div class = "container">
    <h1>CRIE SUA CONTA</h1>
    <form action = "../controle/cadastrar_usuario_controle.php" method ="post">
    <div class = "row justify-content-between"></div>
    <div class="mb-3">
    <label for="nome">Nome*</label>
    <input type="text" class="form-control" name = "nome" id="nome" required placeholder="Seu nome completo">
    </div>
    <div class="mb-3">
    <label for="usuario">Usuario*</label>
    <input type="text" class="form-control" name = "usuario" id="usuario" required placeholder="Seu usuario">
    </div>
    <div class="mb-3">
    <label for="email">Endereço de email*</label>
    <input type="email" class="form-control" name = "email" id="email" required aria-describedby="emailHelp" placeholder="Seu email">
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
    <input type="text" class="form-control" name = "turma" id="turma" required placeholder="Sua turma">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Aceitar termos</label>
    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar suas informações, com ninguém.</small>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</div>        
</form>
</body>
</head>
</html>