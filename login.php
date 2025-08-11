<?php
session_start();
include("include/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';

    if ($correo && $contrasena) {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            if (password_verify($contrasena, $usuario["contrasena"])) {
                $_SESSION["admin"] = $usuario["nombre"];
                header("Location: admin_panel.php");
                exit();
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "Usuario no encontrado.";
        }
        $stmt->close();
    } else {
        $error = "Por favor, complete todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css"> 
</head>
<body>
    <div class="ring">
       <div class="ring">
    <i style="--clr:#ff0057;"></i>   <!-- Rojo fuerte -->
    <i style="--clr:#fff172;"></i>   <!-- Dorado claro -->
    <i style="--clr:#00cfff;"></i>   <!-- Azul claro -->

        <div class="login">
            <h2>login</h2>

            <?php if (isset($error)) : ?>
                <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="inputBx">
                    <input type="email" name="correo" placeholder="Correo" required>
                </div>

                <div class="inputBx">
                    <input type="password" name="contrasena" placeholder="Contraseña" required>
                </div>

                <div class="inputBx">
                    <input type="submit" value="Iniciar sesión">
                </div>

            </form>
        </div>
    </div>
</body>
</html>
