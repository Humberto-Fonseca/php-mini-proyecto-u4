<?php
// Cada página define $titulo antes de incluir este archivo.
$titulo = $titulo ?? 'Mini Proyecto PHP';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($titulo); ?> | Mini Proyecto PHP</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header class="encabezado">
    <h1>Mini Proyecto PHP – Unidad 4</h1>
    <p>Variables · Estructuras de control · Arreglos · Sesiones</p>
</header>

<?php include __DIR__ . '/menu.php'; ?>

<section class="barra-sesion">
<?php if (sesion_activa()): $s = info_sesion(); ?>
    <span><strong>Hora inicio sesión:</strong> <?php echo $s['inicio']; ?></span>
    <span><strong>Hora actual:</strong> <?php echo $s['ahora']; ?></span>
    <span><strong>Tiempo activo:</strong> <?php echo $s['minutos']; ?> minutos <?php echo $s['segundos']; ?> segundos</span>
    <a class="btn-salir" href="index.php">Salir / Reiniciar sesión</a>
<?php else: ?>
    <span>Sin sesión activa. Inicia sesión en la página de inicio.</span>
<?php endif; ?>
</section>

<main class="contenido">
