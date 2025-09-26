<?php
// Include required files
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$nome = '';
$tetosalarial = '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT Nome, TetoSalarial FROM cargos WHERE CargoID = $id";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
        $nome = $row['Nome'];
        $tetosalarial = $row['TetoSalarial'];
    }
}
?>
<main>
    <div id="cargos" class="tela">
        <form class="crud-form" action="./action/cargos.php" method="post">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <h2>Cadastro de Cargos</h2>
            <input type="text" name="nome" placeholder="Nome do Cargo" value="<?php echo htmlspecialchars($nome); ?>" required>
            <input type="number" name="tetosalarial" placeholder="Teto Salarial" value="<?php echo htmlspecialchars($tetosalarial); ?>" required>
            <button type="submit">Salvar</button>
        </form>
    </div>
</main>
