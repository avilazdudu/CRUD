<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

<main>

  <div class="container">
      <h1>Lista de Funcionários</h1>
      <a href="./salvar-funcionarios.php" class="btn btn-add">Incluir</a> 
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cargo</th>
            <th>Setor</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = 'SELECT FuncionarioID ,f.Nome AS nomeFunc, s.Nome As nomeSetor, c.Nome AS nomeCargo FROM funcionarios AS f
          INNER JOIN cargos AS c ON f.CargoID = c.CargoID
          INNER JOIN setor AS s ON f.SetorID = s.SetorID
          ORDER BY FuncionarioID ASC;';

          $return = mysqli_query($conexao, $sql);

          while($linha = mysqli_fetch_assoc($return)){
            echo '<tr id="'.$linha['FuncionarioID'].'">
                <td>'.$linha['FuncionarioID'].'</td>
            <td>'.$linha['nomeFunc'].'</td>
            <td>'.$linha['nomeCargo'].'</td>
            <td>'.$linha['nomeSetor'].'</td>
            <td>
              <a href="#" class="btn btn-edit">Editar</a>
              <a href="#" class="btn btn-delete">Excluir</a>
            </td>
          </tr>';
          }
          ?>
        </tbody>
      </table>
    </div>

<?php 
  // include dos arquivos
  include_once './include/footer.php';
  ?>