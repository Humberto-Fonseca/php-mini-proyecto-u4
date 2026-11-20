<?php
require __DIR__ . '/includes/sesion.php';
requerir_sesion();

$titulo = 'Variables';
include __DIR__ . '/includes/header.php';

// ---- Declaración de variables de cada tipo ----
$nombre   = "Ana López";          // string
$edad     = 21;                   // int
$promedio = 9.35;                 // float
$activo   = true;                 // boolean
$materias = ["Programación Web", "Bases de Datos", "Redes"]; // array

$datos = [
    'nombre'   => $nombre,
    'edad'     => $edad,
    'promedio' => $promedio,
    'activo'   => $activo,
    'materias' => $materias,
];
?>
<h2>Variables y tipos de datos</h2>

<div class="tarjeta explicacion">
    <h3>¿Cómo se usan las variables en PHP?</h3>
    <p>Una variable en PHP se crea al asignarle un valor y siempre empieza con <code>$</code>
    (por ejemplo <code>$edad = 21;</code>). No hay que declarar el tipo: PHP lo deduce del valor
    (tipado dinámico) y puede cambiar durante la ejecución. Con <code>echo</code> se imprime su contenido
    en la página, y funciones como <code>gettype()</code>, <code>date()</code> o <code>count()</code>
    permiten consultar el tipo, la fecha o el tamaño de un arreglo.</p>
    <?php codigo('
$nombre   = "Ana López";   // string
$edad     = 21;            // int
$promedio = 9.35;          // float
$activo   = true;          // boolean
$materias = ["Programación Web", "Bases de Datos", "Redes"]; // array'); ?>
</div>

<h3>Contenido de las variables (echo)</h3>
<div class="tarjeta resultado">
<?php
echo "<p>Nombre: <strong>" . $nombre . "</strong></p>";
echo "<p>Edad: <strong>$edad</strong> años</p>";            // interpolación en comillas dobles
echo "<p>Promedio: <strong>" . $promedio . "</strong></p>";
echo "<p>Activo: <strong>" . ($activo ? 'true' : 'false') . "</strong></p>";
echo "<p>Materias inscritas (<strong>" . count($materias) . "</strong>): " . implode(', ', $materias) . "</p>";
?>
</div>

<h3>Tabla de tipos de datos (gettype)</h3>
<table>
    <tr><th>Variable</th><th>Tipo (gettype)</th><th>Valor</th></tr>
<?php foreach ($datos as $variable => $valor): ?>
    <tr>
        <td><code>$<?php echo $variable; ?></code></td>
        <td><?php echo gettype($valor); ?></td>
        <td><?php
            if (is_array($valor)) {
                echo implode(', ', $valor);
            } elseif (is_bool($valor)) {
                echo $valor ? 'true' : 'false';
            } else {
                echo $valor;
            }
        ?></td>
    </tr>
<?php endforeach; ?>
</table>

<h3>Funciones útiles sobre variables</h3>
<div class="tarjeta resultado">
<?php
echo "<p><code>date('d/m/Y H:i:s')</code> → " . date('d/m/Y H:i:s') . "</p>";
echo "<p><code>count(\$materias)</code> → " . count($materias) . "</p>";
echo "<p><code>strlen(\$nombre)</code> → " . strlen($nombre) . " caracteres</p>";
echo "<p><code>strtoupper(\$nombre)</code> → " . strtoupper($nombre) . "</p>";
echo "<p><code>round(\$promedio, 1)</code> → " . round($promedio, 1) . "</p>";
echo "<p><code>\$edad + \$promedio</code> → " . ($edad + $promedio) . " (" . gettype($edad + $promedio) . ")</p>";
?>
</div>

<h3>var_dump de cada tipo</h3>
<pre class="codigo"><code><?php
var_dump($nombre, $edad, $promedio, $activo);
var_dump($materias);
?></code></pre>

<?php include __DIR__ . '/includes/footer.php'; ?>
