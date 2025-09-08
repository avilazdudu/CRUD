<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// captura o ID na query string
$id = $_GET['id'];
// montar o SQL
$sql = 'SELECT * FROM cargos WHERE CargoID ='.$id;
// executar o SQL

$return = mysqli_query($conexao, $sql);
// pegar os dados e vai deixar dentro do array 
$dados = mysqli_fetch_assoc($return);
?>
  <main>

       <!-- Telas CRUD -->
   <div id="cargos" class="tela">
    <form class="crud-form" action="./action/cargos.php" method="post">
      <h2>Cadastro de Cargos</h2>
      <input type="text" placeholder="Nome do Cargo" value="<?php echo $dados['Nome']?>">
      <input type="number" placeholder="Teto Salarial" value="<?php echo $dados['TetoSalarial']?>">
      <button type="submit">Salvar</button>
    </form>
  </div>
  </main>

  <?php 
  // include dos arquivos
  include_once './include/footer.php';
  ?>
