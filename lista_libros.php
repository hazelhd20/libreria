<?php
require 'seguridad.php';
require 'conexion.php';

// Definir paginación
$por_pagina = 5;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $por_pagina;

// Manejo de búsqueda con parámetros GET para mantener la paginación
$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';
$condicion_busqueda = '';
$parametros_paginacion = '';

if (!empty($busqueda)) {
  $titulo = mysqli_real_escape_string($conectar, $busqueda);
  $condicion_busqueda = "WHERE titulo_libro LIKE '%$titulo%'";
  $parametros_paginacion = "&buscar=" . urlencode($busqueda);
}

// Consulta principal
$datos = "SELECT * FROM libros
          INNER JOIN autores ON libros.autor_libro = autores.id_autor
          INNER JOIN carreras ON libros.carrera_libro = carreras.id_carrera
          $condicion_busqueda
          LIMIT $inicio, $por_pagina";

$resultado = mysqli_query($conectar, $datos);

// Consulta para paginación (optimizada para búsquedas)
$sql_paginacion = "SELECT COUNT(*) AS total FROM libros $condicion_busqueda";
$res_paginacion = mysqli_query($conectar, $sql_paginacion);
$fila_paginacion = mysqli_fetch_assoc($res_paginacion);
$total_paginas = ceil($fila_paginacion['total'] / $por_pagina);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista libros</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon" />
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">
    <?php include 'barra.php'; ?>
    <div class="contenido2">
      <h2 class="centrar">Lista libros</h2>
      <?php include 'botones_libro.php'; ?>

      <form action="lista_libros.php" method="get" class="formulario_buscar">
        <input type="text" class="campo_buscar" name="buscar" placeholder="Introduzca el nombre del libro"
          value="<?= htmlspecialchars($busqueda) ?>">
        <button type="submit" class="boton boton_buscar">
          <i class='fas fa-search'></i>&nbsp;Buscar
        </button>
        <?php if (!empty($busqueda)): ?>
          <button type="button" onclick="window.location.href='lista_libros.php'" class="boton boton_limpiar">
            <i class="fas fa-trash"></i>&nbsp;Limpiar
          </button>
        <?php endif; ?>
      </form>

      <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
        <table>
          <thead>
            <tr>
              <th class='ancho_id centrar'>ID</th>
              <th>Titulo del libro</th>
              <th>Autor del libro</th>
              <th>Año del libro</th>
              <th>Editorial del libro</th>
              <th>Carrera del libro</th>
              <th class='ancho_botones centrar'>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
              <tr>
                <td class='centrar'><?= htmlspecialchars($fila['id_libro']) ?></td>
                <td><?= htmlspecialchars($fila['titulo_libro']) ?></td>
                <td><?= htmlspecialchars($fila['nombre_autor']) ?></td>
                <td><?= htmlspecialchars($fila['fecha_libro']) ?></td>
                <td><?= htmlspecialchars($fila['editorial_libro']) ?></td>
                <td><?= htmlspecialchars($fila['nombre_carrera']) ?></td>
                <td class='centrar'>
                  <a href='eliminar_libro.php?id=<?= $fila['id_libro'] ?>' onclick='return confirmarEliminar();' class='eliminar'><i class='fas fa-trash'></i></a>
                  <a href='editar_libro.php?id=<?= $fila['id_libro'] ?>' class='editar'><i class='fas fa-edit'></i></a>
                  <a href='ver_libro.php?id=<?= $fila['id_libro'] ?>' class='ver'><i class='fas fa-eye'></i></a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p class='no-datos'>No hay datos disponibles<?= !empty($busqueda) ? ' para la búsqueda "' . htmlspecialchars($busqueda) . '"' : '' ?>.</p>
      <?php endif; ?>

      <!-- Paginación -->
      <?php if ($total_paginas > 1): ?>
        <div class="paginacion">
          <?php if ($pagina_actual > 1): ?>
            <a href="lista_libros.php?pagina=<?= $pagina_actual - 1 ?><?= $parametros_paginacion ?>">Anterior</a>
          <?php endif; ?>

          <?php
          // Mostrar solo algunas páginas alrededor de la actual
          $inicio_paginas = max(1, $pagina_actual - 2);
          $fin_paginas = min($total_paginas, $pagina_actual + 2);

          if ($inicio_paginas > 1) echo '<span>...</span>';

          for ($i = $inicio_paginas; $i <= $fin_paginas; $i++): ?>
            <a href="lista_libros.php?pagina=<?= $i ?><?= $parametros_paginacion ?>" class="<?= $i == $pagina_actual ? 'activo' : '' ?>"><?= $i ?></a>
          <?php endfor;

          if ($fin_paginas < $total_paginas) echo '<span>...</span>';
          ?>

          <?php if ($pagina_actual < $total_paginas): ?>
            <a href="lista_libros.php?pagina=<?= $pagina_actual + 1 ?><?= $parametros_paginacion ?>">Siguiente</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</body>

</html>

<script>
  function confirmarEliminar() {
    return confirm("¿Estás seguro de que deseas eliminar este libro?");
  }
</script>