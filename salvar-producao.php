<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : '';

$clienteID = '';
$produtoID = '';
$funcID = '';
$dataProducao = '';

if ($id !== '') {
  $sql = "SELECT pr.ProducaoID, pr.ClienteID, pr.ProdutoID, pr.FuncionarioID, pr.DataProducao, c.Nome AS NomeCliente, f.Nome AS NomeFunc, p.Nome AS NomeProduto
          FROM producao pr
          INNER JOIN produtos AS p ON pr.ProdutoID = p.ProdutoID
          INNER JOIN funcionarios AS f ON pr.FuncionarioID = f.FuncionarioID
          INNER JOIN clientes AS c ON pr.ClienteID = c.ClienteID
          WHERE pr.ProducaoID = $id
          LIMIT 1";

  $return = mysqli_query($conexao, $sql);
  $dados = $return ? mysqli_fetch_assoc($return) : null;

  if ($dados) {
    $clienteID = isset($dados['ClienteID']) ? $dados['ClienteID'] : '';
    $produtoID = isset($dados['ProdutoID']) ? $dados['ProdutoID'] : '';
    $funcID = isset($dados['FuncionarioID']) ? $dados['FuncionarioID'] : '';
    $dataProducao = isset($dados['DataProducao']) ? $dados['DataProducao'] : '';
  }
}

// listas para popular selects
$sqlProdutos = "SELECT ProdutoID, Nome FROM produtos ORDER BY Nome ASC";
$resProdutos = mysqli_query($conexao, $sqlProdutos);

$sqlFuncionarios = "SELECT FuncionarioID, Nome FROM funcionarios ORDER BY Nome ASC";
$resFuncionarios = mysqli_query($conexao, $sqlFuncionarios);

$sqlClientes = "SELECT ClienteID, Nome FROM clientes ORDER BY Nome ASC";
$resClientes = mysqli_query($conexao, $sqlClientes);

?>
  <main>

    <div id="producao" class="tela">
        <form class="crud-form" method="post" action="./action/producao.php">
        <input type="hidden" name="acao" value="salvar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
          <h2>Cadastro de Produção de Produtos</h2>

          <label for="cliente">Cliente</label>
          <select name="cliente" id="cliente">
            <option value="">Cliente</option>
            <?php
            if ($resClientes) {
              while ($c = mysqli_fetch_assoc($resClientes)) {
                $sel = ($clienteID !== '' && $clienteID == $c['ClienteID']) ? ' selected' : '';
                echo '<option value="'.$c['ClienteID'].'"'.$sel.'>'.htmlspecialchars($c['Nome']).'</option>';
              }
            }
            ?>
          </select>

          <label for="produto">Produto</label>
          <select name="produto" id="produto">
            <option value="">Produto</option>
            <?php
            if ($resProdutos) {
              while ($p = mysqli_fetch_assoc($resProdutos)) {
                $selp = ($produtoID !== '' && $produtoID == $p['ProdutoID']) ? ' selected' : '';
                echo '<option value="'.$p['ProdutoID'].'"'.$selp.'>'.htmlspecialchars($p['Nome']).'</option>';
              }
            }
            ?>
          </select>

          <label for="data">Data da produção</label>
          <input type="date" name="data" id="data" value="<?php echo htmlspecialchars($dataProducao); ?>">

          <label for="funcionario">Funcionário</label>
          <select name="funcionario" id="funcionario">
            <option value="">Funcionário</option>
            <?php
            if ($resFuncionarios) {
              while ($f = mysqli_fetch_assoc($resFuncionarios)) {
                $self = ($funcID !== '' && $funcID == $f['FuncionarioID']) ? ' selected' : '';
                echo '<option value="'.$f['FuncionarioID'].'"'.$self.'>'.htmlspecialchars($f['Nome']).'</option>';
              }
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