<?php
// Cabecera para indicar que devolvemos JSON
header('Content-Type: application/json; charset=utf-8');

// Función para limpiar datos
function limpiarDato($dato) {
    if (!isset($dato)) return '';
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato, ENT_QUOTES, 'UTF-8');
    return $dato;
}

// Array para la respuesta
$respuesta = [
    'exito' => false,
    'mensaje' => '',
    'datos' => []
];

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $respuesta['mensaje'] = 'Método no permitido';
    echo json_encode($respuesta);
    exit;
}

// Recibir y limpiar datos
$nombre = limpiarDato($_POST['nombre'] ?? '');
$email = limpiarDato($_POST['email'] ?? '');
$telefono = limpiarDato($_POST['telefono'] ?? '');
$fecha_nac = limpiarDato($_POST['fecha_nac'] ?? '');
$genero = limpiarDato($_POST['genero'] ?? '');

$fecha_evento = limpiarDato($_POST['fecha_evento'] ?? '');
$tipo_entrada = limpiarDato($_POST['tipo_entrada'] ?? '');

// Preferencias de comida
$comida = $_POST['comida'] ?? [];
$comida_limpia = [];
foreach ($comida as $preferencia) {
    $comida_limpia[] = limpiarDato($preferencia);
}

$username = limpiarDato($_POST['username'] ?? '');
$recibir_email = isset($_POST['recibir_email']) ? 'Sí' : 'No';
$acepta_tc = isset($_POST['acepta_tc']) ? 'Sí' : 'No';
$valoracion = intval($_POST['valoracion'] ?? 5);
$comentarios = limpiarDato($_POST['comentarios'] ?? '');

// Archivo
$archivo = '';
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
    $archivo = limpiarDato($_FILES['archivo']['name']);
}

// Validaciones básicas
$errores = [];

if (empty($nombre)) $errores[] = "El nombre es obligatorio";
if (empty($email)) $errores[] = "El email es obligatorio";
if (empty($fecha_nac)) $errores[] = "La fecha de nacimiento es obligatoria";
if (empty($genero)) $errores[] = "El género es obligatorio";
if (empty($fecha_evento)) $errores[] = "La fecha del evento es obligatoria";
if (empty($tipo_entrada)) $errores[] = "El tipo de entrada es obligatorio";
if (empty($username)) $errores[] = "El nombre de usuario es obligatorio";
if (!isset($_POST['acepta_tc'])) $errores[] = "Debes aceptar los términos";

// Si hay errores
if (!empty($errores)) {
    $respuesta['exito'] = false;
    $respuesta['mensaje'] = 'Errores en el formulario';
    $respuesta['errores'] = $errores;
    echo json_encode($respuesta);
    exit;
}

// Si todo está bien
$respuesta['exito'] = true;
$respuesta['mensaje'] = '¡Registro exitoso!';
$respuesta['datos'] = [
    'nombre' => $nombre,
    'email' => $email,
    'telefono' => $telefono,
    'fecha_nac' => $fecha_nac,
    'genero' => $genero,
    'fecha_evento' => $fecha_evento,
    'tipo_entrada' => $tipo_entrada,
    'comida' => $comida_limpia,
    'username' => $username,
    'recibir_email' => $recibir_email,
    'acepta_tc' => $acepta_tc,
    'valoracion' => $valoracion,
    'comentarios' => $comentarios,
    'archivo' => $archivo
];

// Devolver JSON
echo json_encode($respuesta);
?>