<?php
// include dos arquivos
include_once '../include/logado.php';
include_once '../include/conexao.php';

// captura a acao dos dados
$acao = $_REQUEST['acao'] ?? '';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

switch ($acao) {
    case 'excluir':
        // Verificar se a categoria está sendo referenciada em outra tabela
        $checkSql = 'SELECT COUNT(*) AS total FROM produtos WHERE CategoriaID = '.$id;
        $checkResult = mysqli_query($conexao, $checkSql);
        $checkRow = mysqli_fetch_assoc($checkResult);

        if ($checkRow['total'] > 0) {
            // Exibir alerta de erro via JavaScript
            echo "<script>
                    alert('A categoria não pode ser excluída porque está sendo utilizada em outra tabela.');
                    window.location.href = '../lista-categorias.php';
                  </script>";
        } else {
            // Excluir a categoria
            $sql = 'DELETE FROM categorias WHERE CategoriaID = '.$id;
            mysqli_query($conexao, $sql);
            header("Location: ../lista-categorias.php?sucesso=categoria_excluida");
        }
        break;

    case 'salvar':
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);

        if ($id > 0) {
            $sql = "UPDATE categorias SET Nome = '$nome', Descricao = '$descricao' WHERE CategoriaID = $id";
        } else {
            $sql = "INSERT INTO categorias (Nome, Descricao) VALUES ('$nome', '$descricao')";
        }

        if (!mysqli_query($conexao, $sql)) {
            die("Erro ao salvar a categoria: " . mysqli_error($conexao));
        }

        header("Location: ../lista-categorias.php?sucesso=categoria_salva");
        break;

    default:
        break;
}
?>