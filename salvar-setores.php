<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// captura o ID na query string
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id) {
    // montar o SQL
    $sql = 'SELECT * FROM setor WHERE SetorID = '.$id;

    // executar o SQL
    $return = mysqli_query($conexao, $sql);

    // pegar os dados e vai deixar dentro do array 
    $dados = mysqli_fetch_assoc($return);
} else {
    $dados = ['Nome' => '', 'Andar' => '', 'Cor' => ''];
}
?>
  
  <main>

    <div id="setores" class="tela">
        <form class="crud-form" method="post" action="">
          <h2>Cadastro de Setores</h2>
          <input type="text" placeholder="Nome do Setor" value="<?php echo $dados['Nome']?>">
          <input type="text" placeholder="Andar" value="<?php echo $dados['Andar']?>">
          <input type="text" placeholder="Cor" value="<?php echo $dados['Cor']?>">
          <button type="submit">Salvar</button>
        </form>
      </div>
   
  </main>

  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>