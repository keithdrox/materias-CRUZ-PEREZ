<?php
declare(strict_types=1);
require_once __DIR__ . '/Database.php';

class MateriaRepository {
    public function findAll(): array {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM materias WHERE activa = TRUE ORDER BY semestre, nombre");
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM materias WHERE id = :id AND activa = TRUE");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function create(string $codigo, string $nombre, int $creditos, int $semestre): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO materias (codigo, nombre, creditos, semestre, activa) VALUES (:codigo, :nombre, :creditos, :semestre, TRUE)");
        return $stmt->execute([
            'codigo' => $codigo,
            'nombre' => $nombre,
            'creditos' => $creditos,
            'semestre' => $semestre
        ]);
    }

    public function update(int $id, string $codigo, string $nombre, int $creditos, int $semestre): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE materias SET codigo = :codigo, nombre = :nombre, creditos = :creditos, semestre = :semestre WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'codigo' => $codigo,
            'nombre' => $nombre,
            'creditos' => $creditos,
            'semestre' => $semestre
        ]);
    }

    public function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE materias SET activa = FALSE WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
