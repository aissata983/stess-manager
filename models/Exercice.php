<?php
/**
 * Modele des exercices
 */

class Exercice
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Retourne tous les exercices actifs
     */
    public function getAllActive(): array
    {
        $sql = "SELECT *
                FROM exercices
                WHERE actif = 1
                ORDER BY ordre_affichage ASC, id ASC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Trouve un exercice par son ID
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM exercices WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        $exercice = $stmt->fetch();
        return $exercice ?: null;
    }

    /**
     * Trouve un exercice par son slug
     */
    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT * FROM exercices WHERE slug = :slug AND actif = 1 LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':slug' => $slug]);

        $exercice = $stmt->fetch();
        return $exercice ?: null;
    }

    /**
     * Nombre total d'exercices
     */
    public function countAll(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM exercices WHERE actif = 1";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }
}
