<?php
ob_start();
?>
<h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>
<?php if (!empty($errores)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form action="<?= htmlspecialchars($action, ENT_QUOTES, 'UTF-8') ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
    <div style="margin-bottom:10px;">
        <label>Código:</label>
        <input type="text" name="codigo" value="<?= htmlspecialchars($materia['codigo'] ?? '', ENT_QUOTES, 'UTF-8') ?>" maxlength="6" pattern=".{6}" required title="6 caracteres exactos">
    </div>
    <div style="margin-bottom:10px;">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($materia['nombre'] ?? '', ENT_QUOTES, 'UTF-8') ?>" minlength="5" maxlength="80" required>
    </div>
    <div style="margin-bottom:10px;">
        <label>Créditos (1-6):</label>
        <input type="number" name="creditos" value="<?= htmlspecialchars((string)($materia['creditos'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" min="1" max="6" required>
    </div>
    <div style="margin-bottom:10px;">
        <label>Semestre (1-10):</label>
        <input type="number" name="semestre" value="<?= htmlspecialchars((string)($materia['semestre'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" min="1" max="10" required>
    </div>
    <button type="submit" class="btn">Guardar</button>
</form>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>
