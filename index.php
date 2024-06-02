<!DOCTYPE html>
<html>

<?php
require __DIR__ . '/users.php'
?>



<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main">
        <h3>Ingresa tu informacion</h3>
        <form action="" method="post">
            <label for="email">
                Correo:
            </label>
            <input type="text" id="email" name="email" placeholder="Ingresa tu correo" required>

            <label for="password">
                Contraseña:
            </label>
            <input type="password" id="password" name="password" placeholder="ingresa tu contraseña" required>

            <div class="wrap">
                <input type="submit" name="login" value="login">
                </input>
            </div>
        </form>
        <p>No tienes una cuenta?
            <a href="register.php" style="text-decoration: none;">
                Registrarse
            </a>
        </p>
    </div>





    <?php

    if (isset($_POST['login'])) {

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    ?>

            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Correo electronico invalido.
            </div>

    <?php

        } else {



            $result = login($_POST['email'], $_POST['password']);

            switch ($result) {
                case "admin":
                    header("Location: http://localhost:8000/cine_admin.php", true, 301);
                    exit();

                case "user":
                    header("Location: http://localhost:8000/cine_user.php", true, 301);
                    exit();

                case "error":
            }
        }
    }

    ?>



</body>

</html>