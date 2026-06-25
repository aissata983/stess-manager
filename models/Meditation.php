<?php
/**
 * Modele des meditations
 */

class Meditation
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Retourne toutes les meditations actives
     */
    public function getAllActive(): array
    {
        $sql = "SELECT *
                FROM meditations
                WHERE actif = 1
                ORDER BY ordre_affichage ASC, id ASC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Trouve une meditation par slug
     */
    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT *
                FROM meditations
                WHERE slug = :slug AND actif = 1
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':slug' => $slug]);

        $meditation = $stmt->fetch();
        return $meditation ?: null;
    }

    /**
     * Trouve une meditation par ID
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM meditations WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        $meditation = $stmt->fetch();
        return $meditation ?: null;
    }

    /**
     * Nombre total de meditations
     */
    public function countAll(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM meditations WHERE actif = 1";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }
}
