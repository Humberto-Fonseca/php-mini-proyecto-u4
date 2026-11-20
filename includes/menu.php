<?php
// Menú común. El enlace de la página actual se marca como "activo".
$paginaActual = basename($_SERVER['PHP_SELF']);
$enlaces = [
    'index.php'          => 'Inicio',
    'variables.php'      => 'Variables',
    'condicionales.php'  => 'Condicionales',
    'bucles.php'         => 'Bucles',
    'arreglos.php'       => 'Arreglos',
    'sesiones.php'       => 'Sesiones',
];
?>
<nav class="menu">
    <ul>
<?php foreach ($enlaces as $archivo => $texto): ?>
        <li><a href="<?php echo $archivo; ?>"<?php echo $archivo === $paginaActual ? ' class="activo"' : ''; ?>><?php echo $texto; ?></a></li>
<?php endforeach; ?>
    </ul>
</nav>
