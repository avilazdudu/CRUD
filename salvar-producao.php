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
            <option value="">- Selecionar Funcionário -</option>
            <?php
            $sqlfunc = 'SELECT ProducaoID, f.FuncionarioID AS FuncionarioID, DataProducao ,f.Nome AS NomeFunc FROM producao
            INNER JOIN funcionarios AS f ON producao.FuncionarioID = f.FuncionarioID
            GROUP BY f.FuncionarioID
            ORDER BY ProducaoID ASC;';
  
            $returnfunc = mysqli_query($conexao, $sqlfunc);
      
            while($linhafunc = mysqli_fetch_assoc($returnfunc)){
            echo ' <option id="'.$linhafunc['FuncionarioID'].'">'.$linhafunc['NomeFunc'].'</option>';
            }
            ?>
          </select>
          <select>
            <option value="">- Selecionar Produto -</option>
            <?php
            $sqlprod = 'SELECT ProducaoID, p.ProdutoID AS ProdutoID, DataProducao ,p.Nome AS NomeProduto FROM producao
            INNER JOIN produtos AS p ON producao.ProdutoID = p.ProdutoID
            GROUP BY p.ProdutoID
            ORDER BY ProducaoID ASC;';
  
            $returnprod = mysqli_query($conexao, $sqlprod);

            while($linhaprod = mysqli_fetch_assoc($returnprod)){
            echo ' <option id="'.$linhaprod['ProdutoID'].'">'.$linhaprod['NomeProduto'].'</option>';
            }
            ?>
          </select>
          <label for="">Data da entrega</label>
          <input type="date" placeholder="Data da Entrega">
          <select name="" id="">
            <option value="">- Selecionar Cliente -</option>
            <?php
            $sql = 'SELECT  c.ClienteID AS ClienteID, c.Nome  AS NomeCliente FROM producao
            INNER JOIN clientes AS c ON producao.ClienteID = c.ClienteID;
            GROUP BY c.ClienteID;';
  
            $return = mysqli_query($conexao, $sql);

            while($linha = mysqli_fetch_assoc($return)){
            echo ' <option id="'.$linha['ClienteID'].'">'.$lina['NomeCliente'].'</option>';
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