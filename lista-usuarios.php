<?php
// Include required files
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';
?>
<main>
    <div class="container">
        <h1>Lista de Usuários</h1>
        <a href="./salvar-usuarios.php" class="btn btn-add">Incluir</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT UsuarioID, Nome, Email FROM usuarios;';
                $return = mysqli_query($conexao, $sql);

                while ($linha = mysqli_fetch_assoc($return)) {
                    echo '<tr id="'.$linha['UsuarioID'].'">
                        <td>'.$linha['UsuarioID'].'</td>
                        <td>'.$linha['Nome'].'</td>
                        <td>'.$linha['Email'].'</td>
                        <td>
                            <a href="./salvar-usuarios.php?id='.$linha['UsuarioID'].'" class="btn btn-edit">Editar</a>
                            <a href="./action/usuarios.php?id='.$linha['UsuarioID'].'&acao=excluir" class="btn btn-delete">Excluir</a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php
include_once './include/footer.php';
?>
