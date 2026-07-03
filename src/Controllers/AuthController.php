<?php
declare(strict_types=1);
require_once __DIR__ . '/../Repositories/UsuarioRepository.php';

class AuthController {
    public function showLogin(array $errores = []): void {
        require __DIR__ . '/../Views/login.php';
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            return;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $repo = new UsuarioRepository();
        $user = $repo->findByUsername($username);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['rol'] = $user['rol'];
            
            // Prevenir fijación de sesión
            session_regenerate_id(true);

            header("Location: /materias", true, 302);
            exit;
        }

        $this->showLogin(['Credenciales inválidas.']);
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        header("Location: /login", true, 302);
        exit;
    }
}
