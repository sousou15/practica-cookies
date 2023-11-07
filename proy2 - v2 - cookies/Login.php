<?php
session_start(); // Inicia la sesión



//Genera archivo con el parámetro dado. En este caso la fecha.
function generarTiempo( $datos ) {
    file_put_contents('fecha.txt', $datos);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica las credenciales del usuario (por ejemplo, en una base de datos)
    $usuario = $_POST["username"];
    $contraseña = $_POST["pwd"];
    
    if ($usuario == "admin" && $contraseña == "1234") {
        // Si las credenciales son correctas, establece una cookie para mantener la sesión
        setcookie('nombre_usuario', $usuario, time() + 3600, '/');
        $_SESSION['id'] = true; 
        // Registra el tiempo de inicio de sesión
        $_SESSION['inicio_sesion'] = date('Y-m-d H:i:s');
        generarTiempo( $_SESSION['inicio_sesion']);
        header('Location: principal.html');
        exit;
    } else if ($usuario == "usuario1" && $contraseña == "1999") {
        setcookie('nombre_usuario', $usuario, time() + 3600, '/');
        $_SESSION['id'] = true; 
        // Registra el tiempo de inicio de sesión
        $_SESSION['inicio_sesion'] = date('Y-m-d H:i:s');
        generarTiempo( $_SESSION['inicio_sesion']);

        header('Location: espaciouser.html');
        exit;
    } else {
        // Redirige a la página de inicio de sesión con un mensaje de error
        header('Location: Login.html?error=1');
        exit;
    }





}
/*
// Eliminar sesión y cookies cuando el usuario cierra sesión (puedes hacerlo en otro script o en una página de cierre de sesión)
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    setcookie('nombre_usuario', '', time() - 3600, '/'); // Elimina la cookie de sesión
    header('Location: Login.html');
    exit;
}*/
?>










