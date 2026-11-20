<?php
require __DIR__ . '/includes/sesion.php';
requerir_sesion();

$titulo = 'Bucles';
include __DIR__ . '/includes/header.php';

$productos = [
    ['nombre' => 'Laptop',   'precio' => 12500.00, 'stock' => 5],
    ['nombre' => 'Mouse',    'precio' => 250.50,   'stock' => 40],
    ['nombre' => 'Teclado',  'precio' => 480.00,   'stock' => 18],
    ['nombre' => 'Monitor',  'precio' => 3200.00,  'stock' => 0],
];
$lenguajes = ['PHP', 'JavaScript', 'Python', 'Java', 'C#'];
?>
<h2>Bucles: for, while y foreach</h2>

<div class="tarjeta explicacion">
    <h3>¿Cómo se usan los ciclos para repetir tareas?</h3>
    <p>Los bucles ejecutan un bloque de código varias veces sin tener que escribirlo repetidamente.
    <code>for</code> se usa cuando se conoce el número de repeticiones (contador inicial, condición e incremento);
    <code>while</code> repite mientras una condición siga siendo verdadera; y <code>foreach</code> recorre
    cada elemento de un arreglo, ideal para generar listas y tablas dinámicas a partir de datos.</p>
</div>

<h3>for: tabla de multiplicar del 7</h3>
<div class="tarjeta resultado">
<table>
    <tr><th>Operación</th><th>Resultado</th></tr>
<?php for ($i = 1; $i <= 10; $i++): ?>
    <tr><td>7 × <?php echo $i; ?></td><td><?php echo 7 * $i; ?></td></tr>
<?php endfor; ?>
</table>
<?php codigo('
for ($i = 1; $i <= 10; $i++) {
    echo "7 x $i = " . (7 * $i);
}'); ?>
</div>

<h3>for anidado: tabla de multiplicar 1–5</h3>
<table>
    <tr><th>×</th><?php for ($c = 1; $c <= 5; $c++) { echo "<th>$c</th>"; } ?></tr>
<?php for ($f = 1; $f <= 5; $f++): ?>
    <tr>
        <th><?php echo $f; ?></th>
        <?php for ($c = 1; $c <= 5; $c++) { echo "<td>" . ($f * $c) . "</td>"; } ?>
    </tr>
<?php endfor; ?>
</table>

<h3>while: acumular hasta superar el presupuesto de $20,000</h3>
<div class="tarjeta resultado">
<?php
$presupuesto = 20000;
$total = 0;
$indice = 0;
echo "<ul class='lista-ejemplo'>";
while ($indice < count($productos) && $total + $productos[$indice]['precio'] <= $presupuesto) {
    $total += $productos[$indice]['precio'];
    echo "<li>Se agregó <strong>" . $productos[$indice]['nombre'] . "</strong> → total acumulado: $" . number_format($total, 2) . "</li>";
    $indice++;
}
echo "</ul>";
echo "<p>Se compraron <strong>$indice</strong> producto(s) y el total fue $" . number_format($total, 2) . ".</p>";
if ($indice < count($productos)) {
    echo "<p>El siguiente producto (" . $productos[$indice]['nombre'] . ") ya no cabe en el presupuesto.</p>";
}
?>
<?php codigo('
while ($indice < count($productos) && $total + $productos[$indice][\'precio\'] <= $presupuesto) {
    $total += $productos[$indice][\'precio\'];
    $indice++;
}'); ?>
</div>

<h3>while: cuenta regresiva y serie de Fibonacci</h3>
<div class="tarjeta resultado">
<?php
$n = 5;
echo "<p>Cuenta regresiva: ";
while ($n > 0) {
    echo $n . "… ";
    $n--;
}
echo "¡Listo!</p>";

$a = 0; $b = 1; $serie = [];
while (count($serie) < 10) {
    $serie[] = $a;
    [$a, $b] = [$b, $a + $b];
}
echo "<p>Fibonacci (10 términos): " . implode(', ', $serie) . "</p>";
?>
</div>

<h3>foreach: lista de lenguajes</h3>
<div class="tarjeta resultado">
<ol>
<?php foreach ($lenguajes as $posicion => $lenguaje): ?>
    <li>(índice <?php echo $posicion; ?>) <?php echo $lenguaje; ?></li>
<?php endforeach; ?>
</ol>
</div>

<h3>foreach: tabla de productos generada dinámicamente</h3>
<table>
    <tr><th>#</th><th>Producto</th><th>Precio</th><th>Stock</th><th>Disponibilidad</th></tr>
<?php $num = 1; foreach ($productos as $producto): ?>
    <tr>
        <td><?php echo $num++; ?></td>
        <td><?php echo $producto['nombre']; ?></td>
        <td>$<?php echo number_format($producto['precio'], 2); ?></td>
        <td><?php echo $producto['stock']; ?></td>
        <td class="<?php echo $producto['stock'] > 0 ? 'aprobado' : 'reprobado'; ?>">
            <?php echo $producto['stock'] > 0 ? 'Disponible' : 'Agotado'; ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>
<?php codigo('
foreach ($productos as $producto) {
    echo $producto[\'nombre\'] . " - $" . $producto[\'precio\'];
}'); ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
