<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>

  
  <main>

    <div id="funcionarios" class="tela">
        <form class="crud-form">
          <h2>Cadastro de Funcionários</h2>
          <input type="text" placeholder="Nome">
          <input type="date" placeholder="Data de Nascimento">
          <input type="email" placeholder="Email">
          <input type="number" placeholder="Salário">
          <select>
            <option value="">Sexo</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
          </select>
          <input type="text" placeholder="CPF">
          <input type="text" placeholder="RG">
          <select>
            <option value="">Cargo</option>
            <?php
            $sqlcargo = 'SELECT f.FuncionarioID AS FuncionarioID, f.CargoID AS CargoID,f.Nome AS nomeFunc, c.Nome AS nomeCargo FROM funcionarios AS f
            INNER JOIN cargos AS c ON f.CargoID = c.CargoID
            GROUP BY c.Nome
            ORDER BY f.FuncionarioID ASC;';
  
            $returncargo = mysqli_query($conexao, $sqlcargo);

            while($linhacargo = mysqli_fetch_assoc($returncargo)){
              echo ' <option value="'.$linhacargo['CargoID'].'">'.$linhacargo['nomeCargo'].'</option>';
            }
            ?>
          </select>
          <select>
            <option value="">Setor</option>
            <?php
            $sqlsetor = 'SELECT f.FuncionarioID AS FuncionarioID, f.SetorID AS SetorID,f.Nome AS nomeFunc, s.Nome AS nomeSetor FROM funcionarios AS f
            INNER JOIN setor AS s ON f.SetorID = s.SetorID
            GROUP BY s.SetorID
            ORDER BY f.FuncionarioID ASC;';
  
            $returnsetor = mysqli_query($conexao, $sqlsetor);

            while($linhasetor = mysqli_fetch_assoc($returnsetor)){
              echo '<option value="'.$linhasetor['SetorID'].'">'.$linhasetor['nomeSetor'].'</option>';
            }
            ?>
          </select>
          <button type="submit">Salvar</button>
        </form>
      </div>
  </main>

  <?php 
  // include dos arquivos
  include_once './include/footer.php';
  ?>
