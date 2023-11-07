<?php
$ruta = getcwd()."";

// En las páginas protegidas, verifica si el usuario tiene una cookie válida
if (isset($_SESSION['id']) || isset($_COOKIE['nombre_usuario'])) {
    $id = $_COOKIE['nombre_usuario'];
} else {
    // Redirige al usuario a la página de inicio de sesión
    header('Location: Login.html');
    exit;
}


if (isset($_POST['fecha'])) {
    // Recupera la fecha de inicio
    if (file_exists('fecha.txt')) {
        $fecha_inicio = file_get_contents('fecha.txt');
        echo $fecha_inicio;
    } else {
        echo "El archivo de fecha no existe.";
    }

}



if (isset($_POST['rutaactual'])) {
    // Obtener y mostrar la ruta actual
    echo $ruta;
}

if (isset($_POST['busqueda'])) {
    $nombreArchivo = $_POST['busqueda'];

    // Directorio actual (donde se encuentra este archivo PHP)
    $directorioActual = $ruta;

    // Ruta completa al archivo buscado
    $rutaArchivo = $directorioActual . '/' . $nombreArchivo;

    if (file_exists($rutaArchivo) && is_file($rutaArchivo)) {
        echo "El archivo '$nombreArchivo' existe en el directorio actual.";
    } else {
        echo "El archivo '$nombreArchivo' no existe en el directorio actual.";
    }
}


$nombreArchivo = 'nuevo_archivo.txt';
$contenido = 'Este es el contenido que se escribirá en el archivo.';


if (isset($_POST['crear'])) {
// Abre el archivo en modo escritura (w) y establece los permisos (0664)
if ($archivo = fopen($nombreArchivo, 'w')) {
    // Escribe en el archivo
    fwrite($archivo, $contenido);

    // Cierra el archivo
    fclose($archivo);

    // Establece los permisos (0664)
    chmod($nombreArchivo, 0664);

    echo "El archivo '$nombreArchivo' se creó y se escribió con éxito.";
} else {
    echo "No se pudo crear el archivo '$nombreArchivo'.";
}
}


// Eliminar sesión y cookies cuando el usuario cierra sesión (puedes hacerlo en otro script o en una página de cierre de sesión)
if (isset($_POST['logout']) && $_POST['logout'] == 'Logout') {
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    setcookie('nombre_usuario', '', time() - 3600, '/'); // Elimina la cookie de sesión
    header('Location: Login.html');
    //exit;
}

?>
