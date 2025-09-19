<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';


?>
  <main>

    <div id="producao" class="tela">
        <form class="crud-form" method="post" action="">
          <h2>Cadastro de Produção de Produtos</h2>
          <select>
            <?php
            $funcSQL = 'SELECT FuncionarioID, Nome FROM funcionarios';
            $funcResult = mysqli_query($conexao, $funcSQL);
            while ($linha = mysqli_fetch_assoc($funcResult)) {
                echo '<option value="'.$linha['FuncionarioID'].'">'.$linha['Nome'].'</option>';
            }
            ?>
          </select>
          <select>
            <?php
            $prodSQL = 'SELECT ProdutoID, Nome FROM produtos';
            $prodResult = mysqli_query($conexao, $prodSQL);
            while ($linha = mysqli_fetch_assoc($prodResult)) {
                echo '<option value="'.$linha['ProdutoID'].'">'.$linha['Nome'].'</option>';
            }
            ?>
          </select>
          <label for="">Data da entrega</label>
          <input type="date" placeholder="Data da Entrega">
          <select>
            <?php
            $clienteSQL = 'SELECT ClienteID, Nome FROM clientes';
            $clienteResult = mysqli_query($conexao, $clienteSQL);
            while ($linha = mysqli_fetch_assoc($clienteResult)) {
                echo '<option value="'.$linha['ClienteID'].'">'.$linha['Nome'].'</option>';
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