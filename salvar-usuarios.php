<?php
// Include required files
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$nome = '';
$email = '';
$usuario='';
$senha='';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT UsuarioID, Nome, Email, Usuario, Senha FROM usuarios WHERE UsuarioID = $id";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
        $nome = $row['Nome'];
        $email = $row['Email'];
        $usuario = $row['Usuario'];
        $senha = $row['Senha'];
    }
}
?>
<main>
    <div id="usuarios" class="tela">
        <form class="crud-form" action="./action/usuarios.php" method="post">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <h2>Cadastro de Usuários</h2>
            <input type="text" name="nome" placeholder="Nome do Usuário" value="<?php echo htmlspecialchars($nome); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
            <input type="text" name="usuario" placeholder="Usuario" value="<?php echo htmlspecialchars($usuario); ?>" required>
            <input type="password" name="senha" placeholder="Senha" value="<?php echo htmlspecialchars($senha); ?>" required> 
            <button type="submit">Salvar</button>
        </form>
    </div>
</main>
