<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// captura o ID na query string
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id) {
    // montar o SQL
    $sql = 'SELECT * FROM categorias WHERE CategoriaID = '.$id;

    // executar o SQL
    $return = mysqli_query($conexao, $sql);

    // pegar os dados e vai deixar dentro do array 
    $dados = mysqli_fetch_assoc($return);
} else {
    $dados = ['Nome' => '', 'Descricao' => ''];
}
?>
  <main>

    <div id="categorias" class="tela">
        <form class="crud-form" method="post" action="">
          <h2>Cadastro de Categorias</h2>
          <input type="text" placeholder="Nome da Categoria" value="<?php echo $dados['Nome']?>">
          <textarea placeholder="Descrição"><?php echo $dados['Descricao']?></textarea>
          <button type="submit">Salvar</button>
        </form>
      </div>


   
  </main>

  <?php 
  // include dos arquivos
  include_once './include/footer.php';
  ?>
