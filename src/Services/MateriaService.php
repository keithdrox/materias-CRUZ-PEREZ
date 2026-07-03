<?php
declare(strict_types=1);
require_once __DIR__ . '/../Repositories/MateriaRepository.php';

class MateriaService {
    private MateriaRepository $repository;

    public function __construct() {
        $this->repository = new MateriaRepository();
    }

    public function getAllMaterias(): array {
        return $this->repository->findAll();
    }

    public function getMateriaById(int $id): ?array {
        return $this->repository->findById($id);
    }

    public function createMateria(string $codigo, string $nombre, int $creditos, int $semestre): array {
        $errores = $this->validate($codigo, $nombre, $creditos, $semestre);
        if (empty($errores)) {
            try {
                $this->repository->create($codigo, $nombre, $creditos, $semestre);
            } catch (Exception $e) {
                // Posible error de unicidad (código duplicado)
                $errores[] = "El código de la materia ya existe.";
            }
        }
        return $errores;
    }

    public function updateMateria(int $id, string $codigo, string $nombre, int $creditos, int $semestre): array {
        $errores = $this->validate($codigo, $nombre, $creditos, $semestre);
        if (empty($errores)) {
            try {
                $this->repository->update($id, $codigo, $nombre, $creditos, $semestre);
            } catch (Exception $e) {
                $errores[] = "Error al actualizar (posible código duplicado).";
            }
        }
        return $errores;
    }

    public function deleteMateria(int $id): bool {
        return $this->repository->delete($id);
    }

    private function validate(string $codigo, string $nombre, int $creditos, int $semestre): array {
        $errores = [];
        if (empty($codigo) || strlen($codigo) !== 6) {
            $errores[] = "El código debe tener exactamente 6 caracteres.";
        }
        if (empty($nombre) || strlen($nombre) < 5 || strlen($nombre) > 80) {
            $errores[] = "El nombre debe tener entre 5 y 80 caracteres.";
        }
        if ($creditos < 1 || $creditos > 6) {
            $errores[] = "Los créditos deben estar entre 1 y 6.";
        }
        if ($semestre < 1 || $semestre > 10) {
            $errores[] = "El semestre debe estar entre 1 y 10.";
        }
        return $errores;
    }
}
