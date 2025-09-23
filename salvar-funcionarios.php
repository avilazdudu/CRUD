<?php
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
 
// variaveis vazias
$nome = '';
$salario = '';
$cpf = '';
$rg = '';
$email = '';
$dataNascimento = '';
$sexo = '';
$setor = '';
$nomeCargo='';
$cargoID = '';
$setorID = '';
// verifica se existe o id na url
if( isset($_GET['id']) ){
  // pega o id
  $id = $_GET['id'];
  // monta o sql
  $sql = "SELECT FuncionarioID, f.Nome AS nomeFunc, DataNascimento, Email, Salario, Sexo, CPF, RG, f.CargoID AS CargoID, f.SetorID AS SetorID, s.Nome AS nomeSetor, c.Nome AS nomeCargo
          FROM funcionarios AS f
          INNER JOIN cargos AS c ON f.CargoID = c.CargoID
          INNER JOIN setor AS s ON f.SetorID = s.SetorID
          WHERE FuncionarioID = " . intval($id) . " LIMIT 1";
  // executa o sql
  $resultado = mysqli_query($conexao, $sql);
  // pega o resultado
  $row = mysqli_fetch_assoc($resultado);
  // preenche o valo na variavel
  $nome = $row['nomeFunc'];
  $salario = $row['Salario'];
  $cpf = $row['CPF'];
  $rg = $row['RG'];
  $email = $row['Email'];
  $dataNascimento = $row['DataNascimento'];
  $sexo = $row['Sexo'];
  $setor = $row['nomeSetor'];
  $cargoID = isset($row['CargoID']) ? $row['CargoID'] : '';
  $setorID = isset($row['SetorID']) ? $row['SetorID'] : '';
}

// busca todos os cargos para popular o select
$sqlCargos = "SELECT CargoID, Nome FROM cargos ORDER BY Nome ASC";
$resultadoCargos = mysqli_query($conexao, $sqlCargos);
// busca todos os setores para popular o select
$sqlSetores = "SELECT SetorID, Nome FROM setor ORDER BY Nome ASC";
$resultadoSetores = mysqli_query($conexao, $sqlSetores);
?>
  <main>
    <div id="funcionarios" class="tela">
    <form class="crud-form">
          <h2>Cadastro de Funcionários</h2>
          <input type="text" placeholder="Nome" value="<?php echo $nome ?>">
          <input type="date" placeholder="Data de Nascimento" value="<?php echo $dataNascimento?>">
          <input type="email" placeholder="Email" value="<?php echo $email?>">
          <input type="number" placeholder="Salário" value="<?php echo $salario?>">
          <select name="sexo">
            <option value="">Sexo</option>
            <option value="M" <?php if ($sexo === 'M') echo 'selected'; ?>>Masculino</option>
            <option value="F" <?php if ($sexo === 'F') echo 'selected'; ?>>Feminino</option>
          </select>
          <input type="text" placeholder="CPF" value="<?php echo $cpf?>">
          <input type="text" placeholder="RG" value="<?php echo $rg?>">
          <select name="cargo">
            <option value="">Cargo</option>
            <?php
            if ($resultadoCargos) {
              while($cargo = mysqli_fetch_assoc($resultadoCargos)){
                $selectedCargo = ($cargoID !== '' && $cargoID == $cargo['CargoID']) ? ' selected' : '';
                echo '<option value="'.$cargo['CargoID'].'"'.$selectedCargo.'>'.$cargo['Nome'].'</option>';
              }
            }
            ?>
          </select>
          <select name="setor">
            <option value="">Setor</option>
            <?php
            if ($resultadoSetores) {
              while($setor = mysqli_fetch_assoc($resultadoSetores)){
                $selectedSetor = ($setorID !== '' && $setorID == $setor['SetorID']) ? ' selected' : '';
                echo '<option value="'.$setor['SetorID'].'"'.$selectedSetor.'>'.$setor['Nome'].'</option>';
              }
            }
            ?>
          </select>
          <button type="submit">Salvar</button>
      </div>
  </main>

  <?php 
  // include dos arquivos
  include_once './include/footer.php';
  ?>
