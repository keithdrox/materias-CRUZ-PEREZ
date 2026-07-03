<?php
declare(strict_types=1);

class SessionHelper {
    public static function startSecureSession(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                'lifetime' => 0,
                'path' => '/',
                'domain' => '',
                'secure' => isset($_SERVER['HTTPS']),
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            session_start();
        }

        // Cabeceras de seguridad requeridas
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
        header("X-Frame-Options: DENY");
        header("X-Content-Type-Options: nosniff");
        header("Content-Security-Policy: default-src 'self'");
    }

    public static function checkSession(): void {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized');
        }
    }

    public static function generateCsrfToken(): string {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function verifyCsrfToken(string $token): bool {
        return hash_equals($_SESSION['csrf_token'] ?? '', $token);
    }
}
