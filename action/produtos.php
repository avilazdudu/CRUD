<?php
// include dos arquivos
include_once   '../include/logado.php';
include_once   '../include/conexao.php';

// captura a acao dos dados
$acao = $_REQUEST['acao'] ?? '';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

// validacao
switch ($acao) {
    case 'excluir':
        // Verificar se o produto está sendo referenciado em outra tabela
        // Substituir o SQL abaixo por verificações reais, se necessário
        $checkSql = 'SELECT COUNT(*) AS total FROM producao WHERE ProdutoID = '.$id;
        $checkResult = mysqli_query($conexao, $checkSql);
        $checkRow = mysqli_fetch_assoc($checkResult);

        if ($checkRow['total'] > 0) {
            // Exibir alerta de erro via JavaScript
            echo "<script>
                    alert('O produto não pode ser excluído porque está sendo utilizado em outra tabela.');
                    window.location.href = '../lista-produtos.php';
                  </script>";
        } else {
            // Excluir o produto
            $sql = 'DELETE FROM produtos WHERE ProdutoID = '.$id;
            mysqli_query($conexao, $sql);
            header("Location: ../lista-produtos.php?sucesso=produto_excluido");
        }
        break;

    case 'salvar':
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $preco = mysqli_real_escape_string($conexao, $_POST['preco']);
        $peso = mysqli_real_escape_string($conexao, $_POST['peso']);
        $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
        $categoriaID = intval($_POST['categoria']);

        if ($id > 0) {
            $sql = "UPDATE produtos 
                    SET Nome = '$nome', Preco = '$preco', Peso = '$peso', Descricao = '$descricao', CategoriaID = $categoriaID 
                    WHERE ProdutoID = $id";
        } else {
            $sql = "INSERT INTO produtos (Nome, Preco, Peso, Descricao, CategoriaID) 
                    VALUES ('$nome', '$preco', '$peso', '$descricao', $categoriaID)";
        }

        if (!mysqli_query($conexao, $sql)) {
            die("Erro ao salvar o produto: " . mysqli_error($conexao));
        }

        header("Location: ../lista-produtos.php?sucesso=produto_salvo");
        break;

    default:
        break;
}
?>