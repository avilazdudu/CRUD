<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>
  <main>

    <div class="container">
        <h1>Lista de Produções</h1>
        <a href="./salvar-producao.php" class="btn btn-add">Incluir</a> 
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Produto</th>
              <th>Data</th>
              <th>Funcionário</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $sql = 'SELECT ProducaoID, DataProducao ,f.Nome AS NomeFunc, p.Nome AS NomeProduto FROM producao
          INNER JOIN produtos AS p ON producao.ProdutoID = p.ProdutoID
          INNER JOIN funcionarios AS f ON producao.FuncionarioID = f.FuncionarioID
          ORDER BY ProducaoID ASC;';

          $return = mysqli_query($conexao, $sql);

          $min = 1;
          $max = 50;

          while($linha = mysqli_fetch_assoc($return)){
            echo ' <tr id="'.$linha['ProducaoID'].'">
              <td>'.$linha['ProducaoID'].'</td>
              <td>'.$linha['NomeProduto'].'</td>
              <td>'.$linha['DataProducao'].'</td>
              <td>'.$linha['NomeFunc'].'</td>
              <td>
                <a href="./salvar-producao.php?id='.$linha['ProducaoID'].'" class="btn btn-edit">Editar</a>
                <a href="./action/producao.php?id='.$linha['ProducaoID'].'&acao=excluir" class="btn btn-delete">Excluir</a>
              </td>
            </tr>';
          }
          ?>
          </tbody>
        </table>
      </div>


   
  </main>

  <?php 
  // include dos arquivos
  include_once './include/footer.php';
  ?>