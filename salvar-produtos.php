<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$nome = '';
$preco = '';
$peso = '';
$descricao = '';
$categoria = '';
$nomeCategoria = '';

if(isset($_GET['id'])){
  $id = intval($_GET['id']);

  // busca o produto específico e suas informações
  $sql = "SELECT p.ProdutoID, p.Nome AS NomeProduto, p.Preco, p.Peso, p.Descricao AS Descricao, p.CategoriaID, c.Nome AS NomeCat
          FROM produtos AS p
          INNER JOIN categorias AS c ON p.CategoriaID = c.CategoriaID
          WHERE p.ProdutoID = $id
          LIMIT 1";

  $resultado = mysqli_query($conexao, $sql);
  if ($resultado) {
    $row = mysqli_fetch_assoc($resultado);
    if ($row) {
      $nome = isset($row['NomeProduto']) ? $row['NomeProduto'] : '';
      $preco = isset($row['Preco']) ? $row['Preco'] : '';
      $peso = isset($row['Peso']) ? $row['Peso'] : '';
      $descricao = isset($row['Descricao']) ? $row['Descricao'] : '';
      $categoria = isset($row['CategoriaID']) ? $row['CategoriaID'] : '';
      $nomeCategoria = isset($row['NomeCat']) ? $row['NomeCat'] : '';
    }
  }

}
?>
  
  <main>

    <div id="produtos" class="tela">
        <form class="crud-form" action="./action/produtos.php" method="post">
        <input type="hidden" name="acao" value="salvar">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
          <h2>Cadastro de Produtos</h2>
          <input type="text" name="nome" placeholder="Nome do Produto" value="<?php echo htmlspecialchars($nome); ?>" required>
          <input type="number" step="0.01" name="preco" placeholder="Preço" value="<?php echo htmlspecialchars($preco); ?>" required>
          <input type="number" name="peso" placeholder="Peso (g)" value="<?php echo htmlspecialchars($peso); ?>" required>
          <textarea name="descricao" placeholder="Descrição" required><?php echo htmlspecialchars($descricao); ?></textarea>
          <select name="categoria" required>
            <option value="">Categoria</option>
            <?php
      $categoriaSQL = 'SELECT CategoriaID, Nome FROM categorias';
            $categoriaResult = mysqli_query($conexao, $categoriaSQL);
      while ($linha = mysqli_fetch_assoc($categoriaResult)) {
        $selected = ($linha['CategoriaID'] == $categoria) ? 'selected' : '';
        echo '<option value="'.$linha['CategoriaID'].'" '.$selected.'>'.$linha['Nome'].'</option>';
      }
            ?>
      </select>
          <button type="submit">Salvar</button>
        </form>
    </div>
  </main>

  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>