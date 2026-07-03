<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Materias', ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; background-color: #0056b3; color: white; text-decoration: none; border: none; cursor: pointer; border-radius: 3px; }
        .btn-danger { background-color: #dc3545; }
        .error { color: red; }
    </style>
</head>
<body>
    <header>
        <h1>Sistema de Materias</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="/logout" method="POST" style="display:inline;">
                <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
            </form>
            <a href="/materias" class="btn">Lista de Materias</a>
        <?php endif; ?>
        <hr>
    </header>
    <main>
        <?= $content ?>
    </main>
</body>
</html>
