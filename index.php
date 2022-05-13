<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Fecap</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="main">
        <div class="card">

            <div class="left-img-container">
                <img src="img/logo-responsivo.png" alt="logo-fecap">
            </div>

            <form class="textfield" method="POST" action="root.php">
                <h1>Portal Fecap</h1>
                <input type="text" name="usuario" id="usuario" placeholder="Usuário" required>
                <input type="password" name="senha" id="senha" placeholder="Senha" required>
                <button class="btn-login" type="submit">LOGIN</button>
                <a href="">Esqueceu sua senha?</a>
            </form>
            
        </div>
    </div>


</body>

</html>