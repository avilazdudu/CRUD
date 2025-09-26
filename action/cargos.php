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
            // Check if the cargo is referenced in another table
            $checkSql = "SELECT COUNT(*) AS total FROM funcionarios WHERE CargoID = $id";
            $checkResult = mysqli_query($conexao, $checkSql);
            $checkRow = mysqli_fetch_assoc($checkResult);

            if ($checkRow['total'] > 0) {
                echo "<script>
                        alert('O cargo não pode ser excluído porque está sendo utilizado em outra tabela.');
                        window.location.href = '../lista-cargos.php';
                      </script>";
            } else {
                $sql = "DELETE FROM cargos WHERE CargoID = $id";
                mysqli_query($conexao, $sql);
                header("Location: ../lista-cargos.php?sucesso=cargo_excluido");
            }
        }
        break;

    case 'salvar':
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $tetosalarial = mysqli_real_escape_string($conexao, $_POST['tetosalarial']);

        if ($id > 0) {
            $sql = "UPDATE cargos SET Nome = '$nome', TetoSalarial = '$tetosalarial' WHERE CargoID = $id";
        } else {
            $sql = "INSERT INTO cargos (Nome, TetoSalarial) VALUES ('$nome', '$tetosalarial')";
        }

        if (!mysqli_query($conexao, $sql)) {
            die("Erro ao salvar o cargo: " . mysqli_error($conexao));
        }

        header("Location: ../lista-cargos.php?sucesso=cargo_salvo");
        break;

    default:
        
        break;
}
?>