<?php
require __DIR__ . '/includes/sesion.php';
requerir_sesion();

$titulo = 'Condicionales';
include __DIR__ . '/includes/header.php';

// Datos reales para evaluar
$calificaciones = ['Programación Web' => 95, 'Bases de Datos' => 78, 'Redes' => 64, 'Cálculo' => 52];
$hora = (int) date('G');          // hora actual (0-23)
$diaSemana = (int) date('N');     // 1 = lunes ... 7 = domingo
$minutosActivo = info_sesion()['minutos'];
?>
<h2>Condicionales: if, else, elseif y switch</h2>

<div class="tarjeta explicacion">
    <h3>¿Cómo toman decisiones los condicionales?</h3>
    <p><code>if</code> evalúa una expresión booleana y ejecuta su bloque solo si es verdadera;
    <code>elseif</code> agrega condiciones alternativas y <code>else</code> cubre todo lo demás.
    <code>switch</code> compara una sola variable contra varios valores (<code>case</code>) y es más
    limpio cuando hay muchas opciones exactas; cada caso termina con <code>break</code> y
    <code>default</code> atiende los valores no previstos. Así el programa cambia su salida según
    los datos que tenga en ese momento.</p>
</div>

<h3>if / elseif / else: saludo según la hora actual (<?php echo date('H:i'); ?>)</h3>
<div class="tarjeta resultado">
<?php
if ($hora < 12) {
    $saludo = "Buenos días";
} elseif ($hora < 19) {
    $saludo = "Buenas tardes";
} else {
    $saludo = "Buenas noches";
}
echo "<p>Son las $hora horas, por lo tanto: <strong>$saludo</strong>.</p>";
?>
<?php codigo('
if ($hora < 12)       { $saludo = "Buenos días"; }
elseif ($hora < 19)   { $saludo = "Buenas tardes"; }
else                  { $saludo = "Buenas noches"; }'); ?>
</div>

<h3>if / elseif / else evaluando un arreglo de calificaciones</h3>
<table>
    <tr><th>Materia</th><th>Calificación</th><th>Resultado</th></tr>
<?php foreach ($calificaciones as $materia => $nota):
    if ($nota >= 90) {
        $nivel = 'Excelente'; $clase = 'aprobado';
    } elseif ($nota >= 70) {
        $nivel = 'Aprobado'; $clase = 'aprobado';
    } elseif ($nota >= 60) {
        $nivel = 'Suficiente'; $clase = 'aprobado';
    } else {
        $nivel = 'Reprobado'; $clase = 'reprobado';
    }
?>
    <tr>
        <td><?php echo $materia; ?></td>
        <td><?php echo $nota; ?></td>
        <td class="<?php echo $clase; ?>"><?php echo $nivel; ?></td>
    </tr>
<?php endforeach; ?>
</table>

<h3>switch: día de la semana (<?php echo date('d/m/Y'); ?>)</h3>
<div class="tarjeta resultado">
<?php
switch ($diaSemana) {
    case 1:
        $dia = "Lunes";     $mensaje = "Inicio de semana, a organizar tareas."; break;
    case 2:
        $dia = "Martes";    $mensaje = "Día de avanzar con los proyectos."; break;
    case 3:
        $dia = "Miércoles"; $mensaje = "Mitad de semana."; break;
    case 4:
        $dia = "Jueves";    $mensaje = "Ya casi es fin de semana."; break;
    case 5:
        $dia = "Viernes";   $mensaje = "Último día de clases."; break;
    case 6:
        $dia = "Sábado";    $mensaje = "Día de descanso."; break;
    case 7:
        $dia = "Domingo";   $mensaje = "Día de descanso."; break;
    default:
        $dia = "Desconocido"; $mensaje = "";
}
echo "<p>Hoy es <strong>$dia</strong> (número $diaSemana). $mensaje</p>";
?>
<?php codigo('
switch ($diaSemana) {
    case 1:  $dia = "Lunes"; break;
    case 2:  $dia = "Martes"; break;
    // ...
    default: $dia = "Desconocido";
}'); ?>
</div>

<h3>switch con cadenas: tipo de usuario según el tiempo activo</h3>
<div class="tarjeta resultado">
<?php
$tipo = ($minutosActivo >= 5) ? 'veterano' : (($minutosActivo >= 1) ? 'intermedio' : 'nuevo');
switch ($tipo) {
    case 'nuevo':
        echo "<p>Llevas menos de 1 minuto en el sistema: eres un usuario <strong>nuevo</strong>.</p>";
        break;
    case 'intermedio':
        echo "<p>Llevas $minutosActivo minuto(s) en el sistema: usuario <strong>intermedio</strong>.</p>";
        break;
    case 'veterano':
        echo "<p>Llevas $minutosActivo minutos en el sistema: usuario <strong>veterano</strong>.</p>";
        break;
}
?>
<p><em>Recarga la página después de unos minutos y el resultado del <code>switch</code> cambiará.</em></p>
</div>

<h3>Condicional sobre un arreglo (in_array y count)</h3>
<div class="tarjeta resultado">
<?php
$reprobadas = array_filter($calificaciones, fn($n) => $n < 60);
if (count($reprobadas) > 0) {
    echo "<p>Hay <strong>" . count($reprobadas) . "</strong> materia(s) reprobada(s): " . implode(', ', array_keys($reprobadas)) . ".</p>";
} else {
    echo "<p>No hay materias reprobadas.</p>";
}
if (array_key_exists('Redes', $calificaciones)) {
    echo "<p>La materia <em>Redes</em> existe en el arreglo con calificación " . $calificaciones['Redes'] . ".</p>";
}
?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
