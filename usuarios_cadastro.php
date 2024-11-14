<?php
include 'usuarios_controller.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$nome = $_SESSION['nome'];
$email = $_SESSION['email'];

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

//Pega todos os usuários para preencher os dados da tabela
$users = getUsers();

//Variável que guarda o ID do usuário que será editado
$userToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e sé há um ID para edição de usuário
if (isset($_GET['edit'])) {
    $userToEdit = getUser($_GET['edit']);
}
?>
<?php include 'header.php'; ?>
<body>

    <script src="js/main.jss"></script>

    <h2 style="text-align:center;">Cadastro de Usuários</h2>

    <form method="POST" action="" >
        <input type="hidden" id="id" name="id" value="<?php echo $userToEdit['id'] ?? ''; ?>">
       
        <div class="from-group" style="width:600px; margin:auto;" >
        <label class="mb-0" for="nome" style="text-align: left;">Nome:</label>
        <input class= "form-control" type="text" id="nome" name="nome" value="<?php echo $userToEdit['nome'] ?? ''; ?>" required><br>
        </div> 

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="telefone">Telefone:</label>
        <input class= "form-control" type="text" id="telefone" name="telefone" value="<?php echo $userToEdit['telefone'] ?? ''; ?>" required><br>
        </div>

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="email">Email:</label>
        <input class= "form-control" type="email" id="email" name="email" value="<?php echo $userToEdit['email'] ?? ''; ?>" required><br>
        </div>

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="senha">Senha:</label>
        <input class= "form-control" type="password" id="senha" name="senha" required><br>
        </div>

        <div style="text-align: center;">
        <button type="submit" class="btn btn-primary" name="save" style="padding: 10px 25px;">Salvar</button>
        <button type="submit" class="btn btn-primary" name="update" style="padding: 10px 25px;">Atualizar</button>
        <button type="button" class="btn btn-primary" onclick="clearForm()" style="padding: 10px 25px;">Novo</button>
        </div>
        
        <br>
        <br>
    
    </form>

    <h2 style="text-align:center;">Usuários Cadastrados</h2>
    <table border="1" class="table table-dark table-striped">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <!--Faz um loop FOR no resultset de usuários e preenche a tabela-->
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nome']; ?></td>
                <td><?php echo $user['telefone']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <a class="btn btn-primary" href="?edit=<?php echo $user['id']; ?>">Editar</a>
                    <a class="btn btn-danger" href="?delete=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <?php include 'footer.php'; ?>
</body>
</html>