<?php
/**
 * includes/sesion.php
 * Lógica común de sesión para todas las páginas.
 * IMPORTANTE: este archivo no imprime nada, así que puede usarse
 * antes de enviar HTML (necesario para session_start() y header()).
 */

date_default_timezone_set('America/Mexico_City');

// Inicia (o reanuda) la sesión PHP. Crea la cookie PHPSESSID en el navegador.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** ¿El usuario ya inició sesión? (existe la hora de inicio en $_SESSION) */
function sesion_activa(): bool
{
    return isset($_SESSION['inicio']);
}

/** Si no hay sesión, se manda al usuario al index para que inicie una. */
function requerir_sesion(): void
{
    if (!sesion_activa()) {
        header('Location: index.php');
        exit;
    }
    registrar_visita();
}

/** Guarda en $_SESSION cuántas veces se ha cargado cada página. */
function registrar_visita(): void
{
    $pagina = basename($_SERVER['PHP_SELF']);
    if (!isset($_SESSION['visitas'][$pagina])) {
        $_SESSION['visitas'][$pagina] = 0;
    }
    $_SESSION['visitas'][$pagina]++;
}

/** Inicia una sesión nueva guardando la hora actual con time(). */
function iniciar_sesion(): void
{
    if (!sesion_activa()) {
        session_regenerate_id(true);
        $_SESSION['inicio'] = time();   // marca de tiempo Unix (segundos)
        $_SESSION['visitas'] = [];
    }
}

/** Destruye por completo la sesión actual (datos + cookie). */
function destruir_sesion(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

/** Devuelve hora de inicio, hora actual y tiempo activo ya calculados. */
function info_sesion(): array
{
    $inicio = $_SESSION['inicio'];
    $ahora = time();
    $diferencia = $ahora - $inicio;          // hora actual - hora inicio
    return [
        'inicio'    => date('H:i:s', $inicio),
        'ahora'     => date('H:i:s', $ahora),
        'minutos'   => intdiv($diferencia, 60),
        'segundos'  => $diferencia % 60,
        'total'     => $diferencia,
    ];
}

/** Imprime un bloque <pre><code> con código de ejemplo (escapado). */
function codigo(string $texto): void
{
    echo '<pre class="codigo"><code>' . htmlspecialchars(trim($texto)) . '</code></pre>';
}
