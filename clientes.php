<?php 
include('lib/conexao.php');
if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    die();
}

$id = $_SESSION['usuario'];

$sql_clientes = "SELECT * FROM clientes WHERE id != '$id'";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <?php if($_SESSION['admin']) { ?>
    <p><a href="cadastrar_cliente.php">Cadastrar um Cliente</a></p> 
    <?php } ?>
    <table border="1" cellpadding="10">
        <thead>
            <th>ID</th>
            <th>É Admin?</th>
            <th>Imagem</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Data de Cadastro</th>
            <?php if($_SESSION['admin']) { ?>
            <th>Ações</th>
            <?php } ?>
        </thead>
        <tbody>
            <?php if($num_clientes == 0) { ?>
                <tr>
                    <td colspan="<?php if($_SESSION['admin']) echo 9; else echo 8; ?>">Nenhum cliente foi cadastrado</td>
                </tr>
            <?php 
            } else {
                while ($cliente = $query_clientes->fetch_assoc()) {
                
                $telefone = "Não informado";
                if(!empty($cliente['telefone'])) {
                    $telefone = formatar_telefone($cliente['telefone']);
                }
                $nascimento = "Não informada";
                if(!empty($cliente['nascimento'])) {
                    $nascimento = formatar_data($cliente['nascimento']);
                }
                $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data']));
                ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php if($cliente['admin']) echo "SIM"; else echo 'NAO'; ?></td>
                    <td><img height="40" src="<?php echo $cliente['foto']; ?>" alt=""></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $telefone; ?></td>
                    <td><?php echo $nascimento; ?></td>
                    <td><?php echo $data_cadastro; ?></td>
                    <?php if($_SESSION['admin']) { ?>
                    <td>
                        <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a>
                        <a href="deletar_cliente.php?id=<?php echo $cliente['id']; ?>">Deletar</a>
                    </td>
                    <?php } ?>
                </tr>
                <?php
                }
            } ?>
        </tbody>
    </table>
    <p>
    <a href="logout.php">Sair do Sistema</a>
    </p>
    
</body>
</html>