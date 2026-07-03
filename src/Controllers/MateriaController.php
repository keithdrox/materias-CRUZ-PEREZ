<?php
declare(strict_types=1);
require_once __DIR__ . '/../Services/MateriaService.php';
require_once __DIR__ . '/../SessionHelper.php';

class MateriaController {
    private MateriaService $service;

    public function __construct() {
        $this->service = new MateriaService();
    }

    public function index(): void {
        SessionHelper::checkSession();
        $materias = $this->service->getAllMaterias();
        require __DIR__ . '/../Views/materias/index.php';
    }

    public function create(array $errores = [], array $old = []): void {
        SessionHelper::checkSession();
        $csrfToken = SessionHelper::generateCsrfToken();
        $materia = $old;
        $action = '/materias';
        $title = 'Nueva Materia';
        require __DIR__ . '/../Views/materias/form.php';
    }

    public function store(): void {
        SessionHelper::checkSession();
        if (!$this->verifyCsrf()) return;

        $codigo = trim($_POST['codigo'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $creditos = (int)($_POST['creditos'] ?? 0);
        $semestre = (int)($_POST['semestre'] ?? 0);

        $errores = $this->service->createMateria($codigo, $nombre, $creditos, $semestre);

        if (empty($errores)) {
            header("Location: /materias", true, 302);
            exit;
        }

        http_response_code(422);
        $this->create($errores, $_POST);
    }

    public function edit(string $id, array $errores = [], ?array $old = null): void {
        SessionHelper::checkSession();
        $id = (int)$id;
        
        $materia = $old ?? $this->service->getMateriaById($id);
        if (!$materia) {
            http_response_code(404);
            echo "Materia no encontrada.";
            return;
        }

        $csrfToken = SessionHelper::generateCsrfToken();
        $action = "/materias/{$id}";
        $title = 'Editar Materia';
        require __DIR__ . '/../Views/materias/form.php';
    }

    public function update(string $id): void {
        SessionHelper::checkSession();
        if (!$this->verifyCsrf()) return;

        $id = (int)$id;
        $codigo = trim($_POST['codigo'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');
        $creditos = (int)($_POST['creditos'] ?? 0);
        $semestre = (int)($_POST['semestre'] ?? 0);

        $errores = $this->service->updateMateria($id, $codigo, $nombre, $creditos, $semestre);

        if (empty($errores)) {
            header("Location: /materias", true, 302);
            exit;
        }

        http_response_code(422);
        $this->edit((string)$id, $errores, $_POST);
    }

    public function delete(string $id): void {
        SessionHelper::checkSession();
        if (!$this->verifyCsrf()) return;

        $this->service->deleteMateria((int)$id);
        header("Location: /materias", true, 302);
        exit;
    }

    private function verifyCsrf(): bool {
        $token = $_POST['csrf_token'] ?? '';
        if (!SessionHelper::verifyCsrfToken($token)) {
            http_response_code(403);
            echo "Error CSRF: Token inválido.";
            return false;
        }
        return true;
    }
}
