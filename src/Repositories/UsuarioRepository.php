<?php
declare(strict_types=1);
require_once __DIR__ . '/Database.php';

class UsuarioRepository {
    public function findByUsername(string $username): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch();
        return $result ?: null;
    }
}
