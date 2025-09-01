<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>
  <main>

    <div class="container">
        <h1>Lista de Categorias</h1>
        <a href="./salvar-categorias.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php
                // montando o SQL que seá executado no banco de dados
                $sql = 'SELECT * FROM categorias
                ORDER BY CategoriaID ASC;';

                // executar o SQL e guardar o retorno
                $return = mysqli_query($conexao, $sql);

                //listar todos os dados
                while($linha = mysqli_fetch_assoc($return)){
                    echo '<tr>
              <td>'.$linha['CategoriaID'].'</td>
              <td>'.$linha['Nome'].'</td>

              <td>
                <a href="#" class="btn btn-edit">Editar</a>
                <a href="#" class="btn btn-delete">Excluir</a>
              </td>
            </tr>';
                };
                ?>   
          </tbody>
        </table>
      </div>


   
  </main>

  <?php 
  // include dos arquivos
  include_once './include/footer.php';
  ?>