# Mini Proyecto 1 – Unidad 4: Desarrollo Web con PHP

**Materia:** Programación Web – Unidad 4 (Programación del lado del servidor con PHP)

## Integrantes del equipo

- José Jafeth González López
- Humberto Fonseca Morales
- Roberto Trapella Gutiérrez

## Descripción

Sitio web dinámico en PHP que demuestra variables, estructuras de control, arreglos y manejo de
sesiones. Todas las páginas comparten encabezado, menú de navegación y pie de página
(reutilizados con `include`) y muestran en una barra superior la **hora de inicio de sesión**,
la **hora actual** y el **tiempo activo** del usuario.

No usa base de datos, archivos ni formularios: la sesión solo guarda datos en memoria temporal.

## Páginas

| Archivo | Contenido |
|---|---|
| `index.php` | Inicio de sesión (guarda `time()` en `$_SESSION`) y reinicio: destruye cualquier sesión previa con `session_destroy()` |
| `variables.php` | Variables, tipos de datos (string, int, float, boolean, array), `echo`, `date()`, `count()` |
| `condicionales.php` | `if`, `elseif`, `else` y `switch` evaluados con variables y arreglos |
| `bucles.php` | `for`, `while` y `foreach` generando listas y tablas dinámicas |
| `arreglos.php` | Arreglo indexado, asociativo y multidimensional, recorridos con `foreach` y condicionales |
| `sesiones.php` | `session_start()`, `$_SESSION`, cálculo del tiempo activo, persistencia entre páginas |

## Temas de PHP implementados

- Variables y tipos de datos (`string`, `int`, `float`, `bool`, `array`)
- Funciones: `echo`, `date()`, `count()`, `gettype()`, `time()`, `implode()`, `array_sum()`, etc.
- Condicionales: `if`, `elseif`, `else`, `switch`
- Bucles: `for`, `while`, `foreach`
- Arreglos: indexados, asociativos y multidimensionales
- Sesiones: `session_start()`, `$_SESSION`, `session_destroy()`, `time()`
- Reutilización de código con `include` / `require`
- CSS externo

## Estructura

```
├── index.php
├── variables.php
├── condicionales.php
├── bucles.php
├── arreglos.php
├── sesiones.php
├── css/styles.css
├── includes/ (header.php, menu.php, footer.php, sesion.php)
└── img/
```

## Ejecutar localmente

```bash
php -S localhost:8000
```

Abrir <http://localhost:8000>.

## Sitio publicado

<!-- Reemplazar con el enlace final -->
http://php-mini-proyecto-u4.gamer.free
