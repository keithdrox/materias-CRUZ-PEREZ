<?php
$title = 'Listado de Materias';
ob_start();
?>
<h2>Listado de Materias</h2>
<a href="/materias/nueva" class="btn">Nueva Materia</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Créditos</th>
            <th>Semestre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($materias as $m): ?>
            <tr>
                <td><?= htmlspecialchars((string)$m['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($m['codigo'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($m['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars((string)$m['creditos'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars((string)$m['semestre'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <a href="/materias/<?= $m['id'] ?>/editar" class="btn">Editar</a>
                    <form action="/materias/<?= $m['id'] ?>/eliminar" method="POST" style="display:inline;">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\SessionHelper::generateCsrfToken(), ENT_QUOTES, 'UTF-8') ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar?');">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>
