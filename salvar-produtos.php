<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// captura o ID na query string
$id = $_GET['id'];
// montar o SQL
$sql = 'SELECT p.ProdutoID, c.CategoriaID as CategoriaID , p.Nome AS NomeProduto, c.Nome AS NomeCat, Preco, Peso, p.Descricao AS Descri FROM produtos AS p
           INNER JOIN categorias AS c ON p.CategoriaID = c.CategoriaID
           WHERE ProdutoID ='.$id;
// executar o SQL

$return = mysqli_query($conexao, $sql);
// pegar os dados e vai deixar dentro do array 
$dados = mysqli_fetch_assoc($return);
?>
  
  <main>

    <div id="produtos" class="tela">
        <form class="crud-form" action="" method="post">
          <h2>Cadastro de Produtos</h2>
          <input type="text" placeholder="Nome do Produto" value="<?php echo $dados['NomeProduto']?>">
          <input type="number" placeholder="Preço" value="<?php echo $dados['Preco']?>">
          <input type="number" placeholder="Peso (g)" value="<?php echo $dados['Peso']?>">
          <textarea placeholder="Descrição" value="<?php echo $dados['Descri']?>"></textarea>
          <select>
            <option value="<?php echo $dados['NomeCat']?>"><?php echo $dados['NomeCat']?></option>
            <?php
           $sql = 'SELECT p.ProdutoID, c.CategoriaID as CategoriaID , p.Nome AS NomeProduto, c.Nome AS NomeCat, Preco FROM produtos AS p
           INNER JOIN categorias AS c ON p.CategoriaID = c.CategoriaID
           GROUP BY c.Nome
           ORDER BY ProdutoID ASC;';

           $return = mysqli_query($conexao, $sql);

           while($linha = mysqli_fetch_assoc($return)){
            echo '<option id="'.$linha['CategoriaID'].'">'.$linha['NomeCat'].'</option>';
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