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
        $sql = 'DELETE FROM producao WHERE ProducaoID ='.$id;
        mysqli_query($conexao,$sql);
        header("Location: ../lista-producao.php");
        break;

    case 'salvar':
        $produtoID = intval($_POST['produto']);
        $clienteID = intval($_POST['cliente']);
        $funcionarioID = intval($_POST['funcionario']);
        $dataProducao = mysqli_real_escape_string($conexao, $_POST['data']); // Fixed key

        if ($id > 0) {
            $sql = "UPDATE producao 
                    SET ProdutoID = $produtoID, ClienteID = $clienteID, FuncionarioID = $funcionarioID, DataProducao = '$dataProducao' 
                    WHERE ProducaoID = $id";
        } else {
            $sql = "INSERT INTO producao (ProdutoID, ClienteID, FuncionarioID, DataProducao) 
                    VALUES ($produtoID, $clienteID, $funcionarioID, '$dataProducao')";
        }

        if (!mysqli_query($conexao, $sql)) {
            die("Erro ao salvar a produção: " . mysqli_error($conexao));
        }

        header("Location: ../lista-producao.php?sucesso=producao_salva");
        break;

    default:
        break;
}
?>