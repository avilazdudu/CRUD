<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// variaveis vazias
$nome = '';
$descricao = '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// verifica se existe o id na url
if ($id > 0) {
    $sql = "SELECT CategoriaID, Nome, Descricao FROM categorias WHERE CategoriaID = $id";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
        $nome = $row['Nome'];
        $descricao = $row['Descricao'];
    }
}
?>
<main>
    <div id="categorias" class="tela">
        <form class="crud-form" method="post" action="./action/categorias.php">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <h2>Cadastro de Categorias</h2>
            <input type="text" name="nome" placeholder="Nome da Categoria" value="<?php echo htmlspecialchars($nome); ?>" required>
            <textarea name="descricao" placeholder="Descrição" required><?php echo htmlspecialchars($descricao); ?></textarea>
            <button type="submit">Salvar</button>
        </form>
    </div>
</main>
<?php include_once './include/footer.php'; ?>
