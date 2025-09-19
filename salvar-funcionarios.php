<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
$id = $_GET['id'];

$sql = 'SELECT FuncionarioID ,f.SetorID AS FunSID, s.SetorID AS SetSID,f.Nome AS nomeFunc, Sexo, Email, DataNascimento, Salario, CPF, RG, s.Nome As nomeSetor, f.CargoID AS FunCID, c.CargoID As CarCID, c.Nome AS nomeCargo FROM funcionarios AS f
          INNER JOIN cargos AS c ON f.CargoID = c.CargoID
          INNER JOIN setor AS s ON f.SetorID = s.SetorID
          WHERE FuncionarioID ='.$id;
$return = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_assoc($return);

?>
  <main>
    <div id="funcionarios" class="tela">
  <?php
  if (!empty($id)) {
    echo '<form class="crud-form">
          <h2>Cadastro de Funcionários</h2>
          <input type="text" placeholder="Nome" value="'.$dados['nomeFunc'].'">
          <input type="date" placeholder="Data de Nascimento" value="'.$dados['DataNascimento'].'">
          <input type="email" placeholder="Email" value="'.$dados['Email'].'">
          <input type="number" placeholder="Salário" value="'.$dados['Salario'].'">
          <select>
           <option value="'.$dados['Sexo'].'">'.(($dados['Sexo'] == 'M') ? 'Masculino' : 'Feminino').'</option>
           <option value=" ">Sexo</option>
           <option value="'.(($dados['Sexo'] != 'M') ? 'M' : 'F').'">'.(($dados['Sexo'] != 'M') ? 'Masculino' : 'Feminino').'</option>
          </select>
          <input type="text" placeholder="CPF" value="'.$dados['CPF'].'">
          <input type="text" placeholder="RG" value="'.$dados['RG'].'">
          <select>
            <option value="'.$dados['FunCID'].'">'.$dados['nomeCargo'].'</option>';
            
    // Reinicia o ponteiro do resultado para reutilizar a consulta
    $cargoSQL = 'SELECT CargoID, Nome FROM cargos';
    $cargoResult = mysqli_query($conexao, $cargoSQL);
    while ($linha = mysqli_fetch_assoc($cargoResult)) {
        if ($linha['CargoID'] != $dados['FunCID']) {
            echo '<option value="'.$linha['CargoID'].'">'.$linha['Nome'].'</option>';
        }
    }

    echo '</select>
          <select>
            <option value="'.$dados['FunSID'].'">'.$dados['nomeSetor'].'</option>';
            
    // Consulta para setores
    $setorSQL = 'SELECT SetorID, Nome FROM setor';
    $setorResult = mysqli_query($conexao, $setorSQL);
    while ($linha = mysqli_fetch_assoc($setorResult)) {
        if ($linha['SetorID'] != $dados['FunSID']) {
            echo '<option value="'.$linha['SetorID'].'">'.$linha['Nome'].'</option>';
        }
    }

    echo '</select>
          <button type="submit">Salvar</button>
        </form>';
  } else {
    echo '<form class="crud-form">
          <h2>Cadastro de Funcionários</h2>
          <input type="text" placeholder="Nome" value="">
          <input type="date" placeholder="Data de Nascimento" value="">
          <input type="email" placeholder="Email" value="">
          <input type="number" placeholder="Salário" value="">
          <select></select>
          <input type="text" placeholder="CPF" value="">
          <input type="text" placeholder="RG" value="">
          <select>
            <option value="">Cargo</option>
          </select>
          <select>
            <option value="">Setor</option>
          </select>
          <button type="submit">Salvar</button>
        </form>';
  }
  ?>
      </div>
  </main>

  <?php 
  // include dos arquivos
  include_once './include/footer.php';
  ?>
