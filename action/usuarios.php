<?php
// Include required files
include_once '../include/logado.php';
include_once '../include/conexao.php';

// Capture the action
$acao = $_REQUEST['acao'] ?? '';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

switch ($acao) {
    case 'excluir':
        if ($id > 0) {
            $sql = "SELECT UsuarioID FROM usuarios WHERE UsuarioID = $id";
            mysqli_query($conexao, $sql);
            $sql = "DELETE FROM usuarios WHERE UsuarioID = $id";
            mysqli_query($conexao, $sql);
            header("Location: ../lista-usuarios.php?sucesso=usuario_excluido");
        }
        break;

    case 'salvar':
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

        if ($id > 0) {
            $sql = "UPDATE usuarios SET Nome = '$nome', Email = '$email', Usuario = '$usuario', Senha='$senha' WHERE UsuarioID = $id";
        } else {
            $sql = "INSERT INTO usuarios (Nome, Email, Usuario, Senha) VALUES ('$nome', '$email', '$usuario', '$senha')";
        }

        if (!mysqli_query($conexao, $sql)) {
            die("Erro ao salvar o usuário: " . mysqli_error($conexao));
        }

        header("Location: ../lista-usuarios.php?sucesso=usuario_salvo");
        break;

    default:
        break;
}
?>