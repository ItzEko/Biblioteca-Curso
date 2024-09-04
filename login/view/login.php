<!DOCTYPE html>
<html lang="en">
<?php require_once '../../include/headers.html' ?>
<title>LOGIN</title>
<body>
    <div class="container d-flex justify-content-center align-items-center full-height">
        <div class="w-50">
            <header class="text-center my-4">
                <h2>Login</h2>
            </header>
            <main>
                <form class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="Correo" class="form-label">Correo:</label>
                        <div id="correoError" class="text-danger" style="display: none;"></div>
                        <input type="text" class="form-control" id="Correo" name="Correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <div id="contraError" class="text-danger" style="display: none;"></div>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="loginbtn" disabled>Entrar</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script type="module" src="../js/login.js"></script>
</body>
</html>