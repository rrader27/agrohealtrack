<?php
session_start();

// Validar que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../Formularios/iniciar_sesion.html");
    exit();
}

include '../../Php/conexion.php'; // Ajusta la ruta si tu archivo de conexión está en otra carpeta

// Consultar todos los animales registrados por este usuario
$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT id_animal, nombre, especie, raza, edad, estado, marcado, fecha_ingreso 
          FROM animal 
          WHERE usuario_id_usuario = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Animales</title>
    <link rel="stylesheet" href="estilos_p.css">
</head>
<body>
    <div>
        <!-- Barra lateral -->
        <aside>
            <h2>AGROHEALTRACK</h2>
            <nav>
                <a href="../../Formularios/Registrar_animal.html">Registrar Animal</a>
                <a href="../control_usuarios/Panel de control.html">Panel de Control</a>
            </nav>
        </aside>

        <!-- Área principal -->
        <main>
            <section>
                <h1>Listado de Animales</h1>
                <p>Consulta la lista de animales registrados en el sistema.</p>

                <!-- Tabla de animales -->
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Edad</th>
                            <th>Estado del Animal</th>
                            <th>Marcado del Animal</th>
                            <th>Fecha de Ingreso</th>
                            <th>Acciones</th> <!-- Nueva columna -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = $resultado->fetch_assoc()) : ?>
                            <tr>
                                <td><?= htmlspecialchars($fila['nombre']) ?></td>
                                <td><?= htmlspecialchars($fila['especie']) ?></td>
                                <td><?= htmlspecialchars($fila['raza']) ?></td>
                                <td><?= htmlspecialchars($fila['edad']) ?> años</td>
                                <td><?= htmlspecialchars($fila['estado']) ?></td>
                                <td><?= htmlspecialchars($fila['marcado']) ?></td>
                                <td><?= htmlspecialchars($fila['fecha_ingreso']) ?></td>
                                <td>
                                    <a href="../../php/editarAnimales/editar_animal.php?id=<?= $fila['id_animal'] ?>">✏️ Editar</a>
                                    <a href="../../php/editarAnimales/eliminar_animal.php?id=<?= $fila['id_animal'] ?>" onclick="return confirm('¿Estás seguro de eliminar este animal?')">🗑️ Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
