<?php

include('lib/conexao.php');

if(isset($_POST['email']) && isset($_POST['senha'])) {

    

    $email = $mysqli->escape_string($_POST['email']);
    $senha = $_POST['senha'];

    $sql_code = "SELECT * FROM clientes WHERE email = '$email'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query->num_rows == 0) {
        echo "O e-mail informado é incorreto";
    } else {
        $usuario = $sql_query->fetch_assoc();
        if(!password_verify($senha, $usuario['senha'])) {
            echo "A senha informada está incorreta!";
        } else {
            if(!isset($_SESSION))
                session_start();
            $_SESSION['usuario'] = $usuario['id'];
            $_SESSION['admin'] = $usuario['admin'];
            header("Location: clientes.php");
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
</head>
<body>
    <h1>Entrar</h1>
    <form action="" method="POST">
        <p>
            <label for="">E-mail</label>
            <input type="text" name="email">
        </p>
        <p>
            <label for="">Senha</label>
            <input type="password" name="senha">
        </p>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>