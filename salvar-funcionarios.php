<?php
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
 
// variaveis vazias
$nome = '';
$salario = '';
$cpf = '';
$rg = '';
$email = '';
$dataNascimento = '';
$sexo = '';
$cargoID = '';
$setorID = '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// verifica se existe o id na url
if ($id > 0) {
    $sql = "SELECT FuncionarioID, Nome, DataNascimento, Email, Salario, Sexo, CPF, RG, CargoID, SetorID 
            FROM funcionarios WHERE FuncionarioID = $id";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
        $nome = $row['Nome'];
        $salario = $row['Salario'];
        $cpf = $row['CPF'];
        $rg = $row['RG'];
        $email = $row['Email'];
        $dataNascimento = $row['DataNascimento'];
        $sexo = $row['Sexo'];
        $cargoID = $row['CargoID'];
        $setorID = $row['SetorID'];
    }
}

// busca todos os cargos para popular o select
$sqlCargos = "SELECT CargoID, Nome FROM cargos ORDER BY Nome ASC";
$resultadoCargos = mysqli_query($conexao, $sqlCargos);

// busca todos os setores para popular o select
$sqlSetores = "SELECT SetorID, Nome FROM setor ORDER BY Nome ASC";
$resultadoSetores = mysqli_query($conexao, $sqlSetores);
?>
<main>
    <div id="funcionarios" class="tela">
        <form class="crud-form" method="post" action="./action/funcionarios.php">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <h2>Cadastro de Funcionários</h2>
            <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            <input type="date" name="dataNascimento" placeholder="Data de Nascimento" value="<?php echo htmlspecialchars($dataNascimento); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
            <input type="number" name="salario" placeholder="Salário" value="<?php echo htmlspecialchars($salario); ?>" required>
            <select name="sexo" required>
                <option value="">Sexo</option>
                <option value="M" <?php if ($sexo === 'M') echo 'selected'; ?>>Masculino</option>
                <option value="F" <?php if ($sexo === 'F') echo 'selected'; ?>>Feminino</option>
            </select>
            <input type="text" name="cpf" placeholder="CPF" value="<?php echo htmlspecialchars($cpf); ?>" required>
            <input type="text" name="rg" placeholder="RG" value="<?php echo htmlspecialchars($rg); ?>" required>
            <select name="cargo" required>
                <option value="">Cargo</option>
                <?php while ($cargo = mysqli_fetch_assoc($resultadoCargos)) { ?>
                    <option value="<?php echo $cargo['CargoID']; ?>" <?php if ($cargoID == $cargo['CargoID']) echo 'selected'; ?>>
                        <?php echo $cargo['Nome']; ?>
                    </option>
                <?php } ?>
            </select>
            <select name="setor" required>
                <option value="">Setor</option>
                <?php while ($setor = mysqli_fetch_assoc($resultadoSetores)) { ?>
                    <option value="<?php echo $setor['SetorID']; ?>" <?php if ($setorID == $setor['SetorID']) echo 'selected'; ?>>
                        <?php echo $setor['Nome']; ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit">Salvar</button>
        </form>
    </div>
</main>
<?php include_once './include/footer.php'; ?>
