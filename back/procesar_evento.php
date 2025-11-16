<?php
// Función para limpiar datos
function limpiarDato($dato)
{
    if (!isset($dato)) return '';
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato, ENT_QUOTES, 'UTF-8');
    return $dato;
}

// Para recibir cada campo
$nombre = limpiarDato($_POST['nombre'] ?? '');
$email = limpiarDato($_POST['email'] ?? '');
$telefono = limpiarDato($_POST['telefono'] ?? '');
$fecha_nac = limpiarDato($_POST['fecha_nac'] ?? '');
$genero = limpiarDato($_POST['genero'] ?? '');

$fecha_evento = limpiarDato($_POST['fecha_evento'] ?? '');
$tipo_entrada = limpiarDato($_POST['tipo_entrada'] ?? '');

// Preferencias de comida (array)
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

$archivo = '';
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
    $archivo = limpiarDato($_FILES['archivo']['name']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h2 class="mb-0">Registro Exitoso</h2>
            </div>
            <div class="card-body">

                <!-- Información Personal -->
                <h4 class="mt-3 mb-3 text-primary">Información Personal</h4>
                <table class="table table-striped">
                    <tr>
                        <th width="30%">Nombre completo:</th>
                        <td><?php echo $nombre; ?></td>
                    </tr>
                    <tr>
                        <th>Correo electrónico:</th>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <th>Teléfono:</th>
                        <td><?php echo $telefono; ?></td>
                    </tr>
                    <tr>
                        <th>Fecha de nacimiento:</th>
                        <td><?php echo $fecha_nac; ?></td>
                    </tr>
                    <tr>
                        <th>Género:</th>
                        <td><?php echo $genero; ?></td>
                    </tr>
                </table>

                <!-- Información del Evento -->
                <h4 class="mt-4 mb-3 text-primary">Información del Evento</h4>
                <table class="table table-striped">
                    <tr>
                        <th width="30%">Fecha del evento:</th>
                        <td><?php echo $fecha_evento; ?></td>
                    </tr>
                    <tr>
                        <th>Tipo de entrada:</th>
                        <td><?php echo $tipo_entrada; ?></td>
                    </tr>
                    <tr>
                        <th>Preferencias de comida:</th>
                        <td>
                            <?php
                            if (!empty($comida_limpia)) {
                                echo implode(', ', $comida_limpia);
                            } else {
                                echo 'Ninguna';
                            }
                            ?>
                        </td>
                    </tr>
                </table>

                <!-- Información de Acceso -->
                <h4 class="mt-4 mb-3 text-primary">Información de Acceso</h4>
                <table class="table table-striped">
                    <tr>
                        <th width="30%">Nombre de usuario:</th>
                        <td><?php echo $username; ?></td>
                    </tr>
                    <tr>
                        <th>Contraseña:</th>
                        <td>••••••••</td>
                    </tr>
                </table>

                <!-- Preferencias de Contacto -->
                <h4 class="mt-4 mb-3 text-primary">Preferencias de Contacto</h4>
                <table class="table table-striped">
                    <tr>
                        <th width="30%">Recibir notificaciones:</th>
                        <td><?php echo $recibir_email; ?></td>
                    </tr>
                    <tr>
                        <th>Acepta términos y condiciones:</th>
                        <td><?php echo $acepta_tc; ?></td>
                    </tr>
                </table>

                <!-- Encuesta Adicional -->
                <h4 class="mt-4 mb-3 text-primary">Encuesta Adicional</h4>
                <table class="table table-striped">
                    <tr>
                        <th width="30%">Valoración:</th>
                        <td><?php echo $valoracion; ?>/10</td>
                    </tr>
                    <tr>
                        <th>Comentarios:</th>
                        <td><?php echo !empty($comentarios) ? $comentarios : 'Sin comentarios'; ?></td>
                    </tr>
                    <tr>
                        <th>Archivo adjunto:</th>
                        <td><?php echo !empty($archivo) ? $archivo : 'No se adjuntó archivo'; ?></td>
                    </tr>
                </table>

                <div class="mt-4">
                    <a href="../front/formulario.html" class="btn btn-primary">← Volver al formulario</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>