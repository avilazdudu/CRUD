<?php
// Include required files
include_once './include/conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $sql = "SELECT UsuarioID FROM usuarios WHERE Usuario = '$usuario' AND Senha = '$senha'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        session_start();
        $_SESSION['logado'] = true;
        header("Location: ./lista-usuarios.php");
        exit;
    } else {
        $erro = 'Usuário ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Empresarial</title>
  <link rel="stylesheet" href="./assets/style.css">
  <style>
    
  </style>
</head>
<body>
  <header>
    <h1>Sistema de Gestão de Empresa</h1>
  </header>

  
  <main>

    <div id="login" class="tela active">
      <form class="login-form" method="post" action="">
        <h2>Login</h2>
        <?php if ($erro): ?>
          <p style="color: red;"><?php echo htmlspecialchars($erro); ?></p>
        <?php endif; ?>
        <input type="text" name="usuario" placeholder="Usuário" required />
        <input type="password" name="senha" placeholder="Senha" required />
        <button type="submit">Entrar</button>
      </form>
    </div>

   
  </main>

  <script src="./assets/script.js"></script>
</body>
</html>
