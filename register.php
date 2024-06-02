<!DOCTYPE html>
<html>

<?php
require __DIR__ . '/users.php'
?>


<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="sw/package/dist/sweetalert2.min.css">
</head>

<body>

    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="index.php" class="btn btn-primary mt-4">Regresar</a>
                </div>
            </div>
        </div>
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

            <label for="hint">
                Pista:
            </label>
            <input type="text" id="hint" name="hint" placeholder="ingresa una pista para tu contraseña" required>

            <div class="wrap">
                <input type="submit" name="register" value="register">
                </input>
            </div>
        </form>
        <p>Ya tienes una cuenta?
            <a href="index.php" style="text-decoration: none;">
                Inicia sesion
            </a>
        </p>
    </div>
</body>


<?php
if (isset($_POST['register'])) {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
?>

        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            Correo electronico invalido.
        </div>

        <?php

    } else {

        $result = register($_POST['email'], $_POST['password'], $_POST['hint']);

        switch ($result) {
            case "success":
                header("Location: http://localhost:8000/index.php", true, 301);
                exit();

            case "error":

        ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    ERROR.
                </div>
        <?php


        }
    }
}

?>



</body>

</html>