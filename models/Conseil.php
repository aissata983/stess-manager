<?php
/**
 * Modele des conseils anti-stress
 */

class Conseil
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Retourne tous les conseils actifs
     */
    public function getAllActive(): array
    {
        $sql = "SELECT *
                FROM conseils
                WHERE actif = 1
                ORDER BY ordre_affichage ASC, id ASC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Retourne les conseils par categorie
     */
    public function getByCategory(string $categorie): array
    {
        $sql = "SELECT *
                FROM conseils
                WHERE actif = 1 AND categorie = :categorie
                ORDER BY ordre_affichage ASC, id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':categorie' => $categorie]);

        return $stmt->fetchAll();
    }

    /**
     * Trouve un conseil par slug
     */
    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT *
                FROM conseils
                WHERE slug = :slug AND actif = 1
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':slug' => $slug]);

        $conseil = $stmt->fetch();
        return $conseil ?: null;
    }

    /**
     * Retourne toutes les categories disponibles
     */
    public function getCategories(): array
    {
        $sql = "SELECT DISTINCT categorie
                FROM conseils
                WHERE actif = 1
                ORDER BY categorie ASC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Nombre total de conseils
     */
    public function countAll(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM conseils WHERE actif = 1";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }
}
