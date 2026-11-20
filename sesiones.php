<?php
require __DIR__ . '/includes/sesion.php';
requerir_sesion();

$titulo = 'Sesiones';
include __DIR__ . '/includes/header.php';

$s = info_sesion();
?>
<h2>Manejo de sesiones</h2>

<div class="tarjeta explicacion">
    <h3>¿Para qué sirven las sesiones?</h3>
    <p>HTTP no recuerda nada entre una página y otra. Una <strong>sesión</strong> resuelve esto:
    <code>session_start()</code> crea (o reanuda) un espacio de memoria en el servidor identificado por una cookie
    (<code>PHPSESSID</code>) y los datos se guardan en el arreglo superglobal <code>$_SESSION</code>.
    Así se conserva información mientras el usuario navega, sin base de datos ni archivos propios, y se libera con
    <code>session_destroy()</code>.</p>
    <p>Aquí la usamos para guardar la hora de inicio con <code>time()</code> y calcular en cada página
    el tiempo activo = hora actual − hora de inicio.</p>
</div>

<h3>Cálculo del tiempo activo</h3>
<div class="tarjeta resultado">
    <p><code>$_SESSION['inicio']</code> = <strong><?php echo $_SESSION['inicio']; ?></strong> (marca de tiempo Unix devuelta por <code>time()</code>)</p>
    <p>Hora de inicio: <strong><?php echo $s['inicio']; ?></strong></p>
    <p>Hora actual: <strong><?php echo $s['ahora']; ?></strong> (<code>time()</code> = <?php echo time(); ?>)</p>
    <p>Diferencia: <strong><?php echo $s['total']; ?></strong> segundos
       → <strong><?php echo $s['minutos']; ?></strong> minutos y <strong><?php echo $s['segundos']; ?></strong> segundos</p>
    <?php codigo('
$diferencia = time() - $_SESSION[\'inicio\'];
$minutos    = intdiv($diferencia, 60);
$segundos   = $diferencia % 60;'); ?>
</div>

<h3>Datos de la sesión</h3>
<table>
    <tr><th>Dato</th><th>Valor</th></tr>
    <tr><td><code>session_id()</code></td><td><?php echo session_id(); ?></td></tr>
    <tr><td><code>session_name()</code></td><td><?php echo session_name(); ?></td></tr>
    <tr><td><code>$_SESSION['inicio']</code></td><td><?php echo date('d/m/Y H:i:s', $_SESSION['inicio']); ?></td></tr>
    <tr><td>Elementos en <code>$_SESSION</code></td><td><?php echo count($_SESSION); ?></td></tr>
</table>

<h3>Persistencia entre páginas: visitas guardadas en $_SESSION</h3>
<p>Cada vez que se carga una página se incrementa un contador guardado en la sesión.
Navega por otras páginas, regresa aquí y verás que los datos se conservan.</p>
<table>
    <tr><th>Página</th><th>Veces visitada en esta sesión</th></tr>
<?php foreach ($_SESSION['visitas'] as $pagina => $veces): ?>
    <tr><td><?php echo $pagina; ?></td><td><?php echo $veces; ?></td></tr>
<?php endforeach; ?>
    <tr><th>Total</th><th><?php echo array_sum($_SESSION['visitas']); ?></th></tr>
</table>

<h3>Contenido completo de $_SESSION</h3>
<pre class="codigo"><code><?php print_r($_SESSION); ?></code></pre>

<div class="tarjeta explicacion">
    <h3>Reiniciar la sesión</h3>
    <p>Con el botón <em>Salir / Reiniciar sesión</em> (barra superior) se regresa al <code>index.php</code>,
    donde se ejecuta <code>session_destroy()</code>. Después hay que pulsar <em>Iniciar sesión</em> para crear una nueva
    sesión con una hora de inicio distinta.</p>
    <?php codigo('
$_SESSION = [];
session_destroy();           // destruye la sesión actual
// ... y al iniciar de nuevo:
$_SESSION[\'inicio\'] = time(); // nueva hora de inicio'); ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
