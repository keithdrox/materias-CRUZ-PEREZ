<?php
$title = 'Login';
ob_start();
?>
<h2>Iniciar Sesión</h2>
<?php if (!empty($errores)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form action="/login" method="POST">
    <div>
        <label>Usuario:</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit" class="btn" style="margin-top:10px;">Ingresar</button>
</form>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
?>
