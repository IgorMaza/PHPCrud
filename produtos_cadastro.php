<?php
include 'produtos_controller.php';

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
$prods = getProds();

//Variável que guarda o ID do usuário que será editado
$prodToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e sé há um ID para edição de usuário
if (isset($_GET['edit'])) {
    $prodToEdit = getProd($_GET['edit']);
}
?>
<?php include 'header.php'; ?>
<body>

    <script src="js/main.jss"></script>

    <h2 style="text-align:center;">Cadastro de Produtos</h2>

    <form method="POST" action="" >
        <input type="hidden" id="id" name="id" value="<?php echo $prodToEdit['id'] ?? ''; ?>">
       
        <div class="from-group" style="width:600px; margin:auto;" >
        <label class="mb-0" for="nome" style="text-align: left;">Nome:</label>
        <input class= "form-control" type="text" id="nome" name="nome" value="<?php echo $prodToEdit['nome'] ?? ''; ?>" required><br>
        </div> 

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="descricao">Descricão:</label>
        <input class= "form-control" type="text" id="descricao" name="descricao" value="<?php echo $prodToEdit['descricao'] ?? ''; ?>" required><br>
        </div>

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="marca">Marca:</label>
        <input class= "form-control" type="text" id="marca" name="marca" value="<?php echo $prodToEdit['marca'] ?? ''; ?>" required><br>
        </div>

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="modelo">Modelo:</label>
        <input class= "form-control" type="text" id="modelo" name="modelo" value="<?php echo $prodToEdit['modelo'] ?? ''; ?>" required><br>
        </div>

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="valorunitario">Valor Unitario:</label>
        <input class= "form-control" type="double" id="valorunitario" name="valorunitario" value="<?php echo $prodToEdit['valorunitario'] ?? ''; ?>" required><br>
        </div>

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="categoria">Categoria:</label>
        <input class= "form-control" type="text" id="categoria" name="categoria" value="<?php echo $prodToEdit['categoria'] ?? ''; ?>" required><br>
        </div>

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="url_img">Url Img:</label>
        <input class= "form-control" type="text" id="url_img" name="url_img" value="<?php echo $prodToEdit['url_img'] ?? ''; ?>" required><br>
        </div>

        <div class="from-group" style="width:600px; margin:auto;">
        <label class="mb-0" for="ativo">Ativo:</label>
        <input class= "form-control" type="int" id="ativo" name="ativo" value="<?php echo $prodToEdit['ativo'] ?? ''; ?>" required><br>
        </div>

        <div style="text-align: center;">
        <button type="submit" class="btn btn-primary" name="save" style="padding: 10px 25px;">Salvar</button>
        <button type="submit" class="btn btn-primary" name="update" style="padding: 10px 25px;">Atualizar</button>
        <button type="button" class="btn btn-primary" onclick="clearForm()" style="padding: 10px 25px;">Novo</button>
        </div>
        
        <br>
        <br>
    
    </form>

    <h2 style="text-align:center;">Produtos Cadastrados</h2>
    <table border="1" class="table table-dark table-striped">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Valor Unitario</th>
            <th>Categoria</th>
            <th>URL IMG</th>
            <th>Ativo</th>
        </tr>
        <!--Faz um loop FOR no resultset de usuários e preenche a tabela-->
        <?php foreach ($prods as $prod): ?>
            <tr>
                <td><?php echo $prod['id']; ?></td>
                <td><?php echo $prod['nome']; ?></td>
                <td><?php echo $prod['descricao']; ?></td>
                <td><?php echo $prod['marca']; ?></td>
                <td><?php echo $prod['modelo']; ?></td>
                <td><?php echo $prod['valorunitario']; ?></td>
                <td><?php echo $prod['categoria']; ?></td>
                <td><img src="<?php echo $prod['url_img']; ?>" alt="Imagem do Produto"style="width: 100px"></td>
                <td><?php echo $prod['ativo']; ?></td>
                <td>
                    <a class="btn btn-primary" href="?edit=<?php echo $prod['id']; ?>">Editar</a>
                    <a class="btn btn-danger" href="?delete=<?php echo $prod['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <?php include 'footer.php'; ?>
</body>
</html>