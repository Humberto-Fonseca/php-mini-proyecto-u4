<?php
require __DIR__ . '/includes/sesion.php';
requerir_sesion();

$titulo = 'Arreglos';
include __DIR__ . '/includes/header.php';

// Arreglo indexado
$frutas = ['Manzana', 'Plátano', 'Uva', 'Mango'];

// Arreglo asociativo
$alumno = [
    'nombre'  => 'Carlos Ruiz',
    'carrera' => 'Ingeniería en Sistemas',
    'semestre' => 5,
    'promedio' => 88.5,
];

// Arreglo multidimensional (arreglo de arreglos asociativos)
$alumnos = [
    ['nombre' => 'Ana',    'calificaciones' => [95, 90, 100]],
    ['nombre' => 'Luis',   'calificaciones' => [70, 65, 80]],
    ['nombre' => 'María',  'calificaciones' => [55, 40, 60]],
    ['nombre' => 'Pedro',  'calificaciones' => [85, 78, 92]],
];
?>
<h2>Arreglos</h2>

<div class="tarjeta explicacion">
    <h3>¿Para qué sirven y cómo se manipulan?</h3>
    <p>Un arreglo guarda varios valores en una sola variable. Puede ser <strong>indexado</strong>
    (las posiciones son números 0, 1, 2…), <strong>asociativo</strong> (cada valor se identifica con una clave de texto)
    o <strong>multidimensional</strong> (arreglos dentro de arreglos, parecido a una tabla de base de datos).
    Se crean con <code>[ ]</code>, se recorren con <code>foreach</code> y se manipulan con funciones como
    <code>count()</code>, <code>array_push()</code>, <code>sort()</code>, <code>in_array()</code> o <code>array_sum()</code>.</p>
</div>

<h3>1. Arreglo indexado</h3>
<div class="tarjeta resultado">
<?php codigo('$frutas = [\'Manzana\', \'Plátano\', \'Uva\', \'Mango\'];'); ?>
<p>Primer elemento <code>$frutas[0]</code>: <strong><?php echo $frutas[0]; ?></strong> ·
   Total con <code>count()</code>: <strong><?php echo count($frutas); ?></strong></p>
<ul>
<?php foreach ($frutas as $i => $fruta): ?>
    <li>Posición <?php echo $i; ?>: <?php echo $fruta; ?>
        <?php if (strlen($fruta) > 5) { echo '<em>(nombre largo, ' . strlen($fruta) . ' letras)</em>'; } ?>
    </li>
<?php endforeach; ?>
</ul>
<?php
$copia = $frutas;
array_push($copia, 'Sandía');   // agrega al final
sort($copia);                    // ordena alfabéticamente
echo "<p>Después de <code>array_push()</code> y <code>sort()</code>: " . implode(', ', $copia) . "</p>";
echo "<p><code>in_array('Uva', \$frutas)</code>: " . (in_array('Uva', $frutas) ? 'Sí está' : 'No está') . "</p>";
?>
</div>

<h3>2. Arreglo asociativo</h3>
<div class="tarjeta resultado">
<?php codigo('$alumno = [\'nombre\' => \'Carlos Ruiz\', \'carrera\' => \'Ingeniería en Sistemas\', \'semestre\' => 5, \'promedio\' => 88.5];'); ?>
<table>
    <tr><th>Clave</th><th>Valor</th><th>Observación</th></tr>
<?php foreach ($alumno as $clave => $valor): ?>
    <tr>
        <td><code><?php echo $clave; ?></code></td>
        <td><?php echo $valor; ?></td>
        <td>
            <?php
            if (is_numeric($valor) && $clave === 'promedio') {
                echo $valor >= 70 ? 'Promedio aprobatorio' : 'Promedio reprobatorio';
            } elseif (is_int($valor)) {
                echo 'Dato numérico entero';
            } else {
                echo 'Texto';
            }
            ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>
<p>Acceso directo: <code>$alumno['carrera']</code> → <strong><?php echo $alumno['carrera']; ?></strong></p>
</div>

<h3>3. Arreglo multidimensional</h3>
<div class="tarjeta resultado">
<?php codigo('
$alumnos = [
    [\'nombre\' => \'Ana\', \'calificaciones\' => [95, 90, 100]],
    [\'nombre\' => \'Luis\', \'calificaciones\' => [70, 65, 80]],
    // ...
];'); ?>
<table>
    <tr><th>Alumno</th><th>Calificaciones</th><th>Promedio</th><th>Estado</th></tr>
<?php foreach ($alumnos as $a):
    $prom = array_sum($a['calificaciones']) / count($a['calificaciones']);
    if ($prom >= 90) {
        $estado = 'Sobresaliente'; $clase = 'aprobado';
    } elseif ($prom >= 70) {
        $estado = 'Aprobado'; $clase = 'aprobado';
    } else {
        $estado = 'Reprobado'; $clase = 'reprobado';
    }
?>
    <tr>
        <td><?php echo $a['nombre']; ?></td>
        <td><?php echo implode(' – ', $a['calificaciones']); ?></td>
        <td><?php echo number_format($prom, 2); ?></td>
        <td class="<?php echo $clase; ?>"><?php echo $estado; ?></td>
    </tr>
<?php endforeach; ?>
</table>
<p>Acceso a un valor interno: <code>$alumnos[1]['calificaciones'][2]</code> →
   <strong><?php echo $alumnos[1]['calificaciones'][2]; ?></strong> (tercera calificación de <?php echo $alumnos[1]['nombre']; ?>).</p>

<h4>Recorrido anidado (foreach dentro de foreach)</h4>
<ul>
<?php foreach ($alumnos as $a): ?>
    <li><strong><?php echo $a['nombre']; ?></strong>:
    <?php foreach ($a['calificaciones'] as $k => $cal) {
        echo "Examen " . ($k + 1) . " = $cal" . ($cal < 60 ? ' ⚠' : '') . ($k < count($a['calificaciones']) - 1 ? ', ' : '');
    } ?>
    </li>
<?php endforeach; ?>
</ul>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
