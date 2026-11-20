<?php
require __DIR__ . '/includes/sesion.php';

/*
 * Lógica del index:
 *  - ?iniciar=1  -> el usuario pulsa "Iniciar sesión": se guarda time() en $_SESSION.
 *  - sin parámetro -> si existía una sesión, se destruye con session_destroy()
 *                     para que el usuario tenga que iniciarla de nuevo.
 */
$mensaje = '';
if (isset($_GET['iniciar'])) {
    iniciar_sesion();
    registrar_visita();
    $mensaje = 'Sesión iniciada correctamente. Ya puedes navegar por el menú.';
} elseif (sesion_activa()) {
    destruir_sesion();
    $mensaje = 'La sesión anterior fue destruida con session_destroy(). Inicia una nueva sesión para continuar.';
}

$titulo = 'Inicio';
include __DIR__ . '/includes/header.php';
?>
<h2>Bienvenido</h2>

<?php if ($mensaje !== ''): ?>
    <div class="tarjeta resultado"><?php echo $mensaje; ?></div>
<?php endif; ?>

<div class="tarjeta">
    <p>Este sitio dinámico demuestra los fundamentos de PHP: variables, tipos de datos,
    estructuras de control, arreglos y manejo de sesiones.</p>
    <p><strong>Materia:</strong> Programación Web – Unidad 4<br>
    <strong>Equipo:</strong> José Jafeth González López, Humberto Fonseca Morales y Roberto Trapella Gutiérrez</p>
</div>

<?php if (sesion_activa()): ?>
    <div class="tarjeta">
        <h3>Sesión activa</h3>
        <p>Tu sesión comenzó a las <strong><?php echo $_SESSION['inicio'] ? date('H:i:s', $_SESSION['inicio']) : ''; ?></strong>.
        La barra amarilla superior muestra el tiempo que llevas activo en todas las páginas.</p>
        <p><a class="btn" href="variables.php">Comenzar el recorrido →</a></p>
    </div>
<?php else: ?>
    <div class="tarjeta">
        <h3>Inicio de sesión</h3>
        <p>Para ver el contenido debes iniciar una sesión. Al hacerlo se guarda la hora de inicio
        en <code>$_SESSION['inicio']</code> usando <code>time()</code>.</p>
        <p><a class="btn btn-grande" href="index.php?iniciar=1">Iniciar sesión</a></p>
    </div>
<?php endif; ?>

<div class="tarjeta explicacion">
    <h3>¿Cómo funciona este index?</h3>
    <p>Cada vez que se carga <code>index.php</code> sin parámetros, el código revisa si ya existía una sesión
    y, si es así, la destruye (<code>session_destroy()</code>), por lo que el usuario debe iniciar sesión otra vez
    y se crea una nueva hora de inicio. El botón <em>Salir / Reiniciar sesión</em> de la barra superior solo
    regresa a esta página, que es la que realiza la destrucción.</p>
    <?php
    codigo('
if (isset($_GET[\'iniciar\'])) {
    iniciar_sesion();            // $_SESSION[\'inicio\'] = time();
} elseif (sesion_activa()) {
    destruir_sesion();           // session_destroy()
}');
    ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
