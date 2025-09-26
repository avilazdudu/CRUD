<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// variaveis vazias
$nome = '';
$andar = '';
$cor = '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// verifica se existe o id na url
if ($id > 0) {
    $sql = "SELECT SetorID, Nome, Andar, Cor FROM setor WHERE SetorID = $id";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
        $nome = $row['Nome'];
        $andar = $row['Andar'];
        $cor = $row['Cor'];
    }
}
?>
<main>
    <div id="setores" class="tela">
        <form class="crud-form" method="post" action="./action/setores.php">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <h2>Cadastro de Setores</h2>
            <input type="text" name="nome" placeholder="Nome do Setor" value="<?php echo htmlspecialchars($nome); ?>" required>
            <input type="text" name="andar" placeholder="Andar" value="<?php echo htmlspecialchars($andar); ?>" required>
            <input type="text" name="cor" placeholder="Cor" value="<?php echo htmlspecialchars($cor); ?>" required>
            <button type="submit">Salvar</button>
        </form>
    </div>
</main>
<?php include_once './include/footer.php'; ?>