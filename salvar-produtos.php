<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>
  
  <main>

    <div id="produtos" class="tela">
        <form class="crud-form" action="" method="post">
          <h2>Cadastro de Produtos</h2>
          <input type="text" placeholder="Nome do Produto">
          <input type="number" placeholder="Preço">
          <input type="number" placeholder="Peso (g)">
          <textarea placeholder="Descrição"></textarea>
          <select>
            <option value="">Categoria</option>
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