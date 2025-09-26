<?php
// include dos arquivos
include_once '../include/logado.php';
include_once '../include/conexao.php';

// captura a acao dos dados
$acao = $_REQUEST['acao'] ?? '';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

switch ($acao) {
    case 'excluir':
        // Verificar se o funcionário está sendo referenciado em outra tabela
        // Substituir o SQL abaixo por verificações reais, se necessário
        $checkSql = 'SELECT COUNT(*) AS total FROM producao WHERE FuncionarioID = '.$id;
        $checkResult = mysqli_query($conexao, $checkSql);
        $checkRow = mysqli_fetch_assoc($checkResult);

        if ($checkRow['total'] > 0) {
            // Exibir alerta de erro via JavaScript
            echo "<script>
                    alert('O funcionário não pode ser excluído porque está sendo utilizado em outra tabela.');
                    window.location.href = '../lista-funcionarios.php';
                  </script>";
        } else {
            // Excluir o funcionário
            $sql = 'DELETE FROM funcionarios WHERE FuncionarioID = '.$id;
            mysqli_query($conexao, $sql);
            header("Location: ../lista-funcionarios.php?sucesso=funcionario_excluido");
        }
        break;

    case 'salvar':
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $dataNascimento = mysqli_real_escape_string($conexao, $_POST['dataNascimento']);
        $email = mysqli_real_escape_string($conexao, $_POST['email']);
        $salario = mysqli_real_escape_string($conexao, $_POST['salario']);
        $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
        $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
        $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
        $cargoID = intval($_POST['cargo']);
        $setorID = intval($_POST['setor']);

        if ($id > 0) {
            $sql = "UPDATE funcionarios 
                    SET Nome = '$nome', DataNascimento = '$dataNascimento', Email = '$email', Salario = '$salario', 
                        Sexo = '$sexo', CPF = '$cpf', RG = '$rg', CargoID = $cargoID, SetorID = $setorID 
                    WHERE FuncionarioID = $id";
        } else {
            $sql = "INSERT INTO funcionarios (Nome, DataNascimento, Email, Salario, Sexo, CPF, RG, CargoID, SetorID) 
                    VALUES ('$nome', '$dataNascimento', '$email', '$salario', '$sexo', '$cpf', '$rg', $cargoID, $setorID)";
        }

        if (!mysqli_query($conexao, $sql)) {
            die("Erro ao salvar o funcionário: " . mysqli_error($conexao));
        }

        header("Location: ../lista-funcionarios.php?sucesso=funcionario_salvo");
        break;

    default:
        break;
}
?>