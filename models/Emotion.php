<?php
/**
 * Modele des emotions
 */

class Emotion
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Enregistre une emotion
     */
    public function create(int $utilisateurId, string $humeur, ?string $commentaire = null, ?int $niveauStress = null): bool
    {
        $sql = "INSERT INTO emotions (utilisateur_id, humeur, commentaire, niveau_stress, date_enregistrement)
                VALUES (:utilisateur_id, :humeur, :commentaire, :niveau_stress, NOW())";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':utilisateur_id' => $utilisateurId,
            ':humeur' => $humeur,
            ':commentaire' => $commentaire,
            ':niveau_stress' => $niveauStress
        ]);
    }

    /**
     * Retourne les emotions d'un utilisateur
     */
    public function getByUser(int $utilisateurId, int $limit = 20): array
    {
        $sql = "SELECT *
                FROM emotions
                WHERE utilisateur_id = :utilisateur_id
                ORDER BY date_enregistrement DESC
                LIMIT :limite";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->bindValue(':limite', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Retourne la derniere emotion d'un utilisateur
     */
    public function getLatestByUser(int $utilisateurId): ?array
    {
        $sql = "SELECT *
                FROM emotions
                WHERE utilisateur_id = :utilisateur_id
                ORDER BY date_enregistrement DESC
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':utilisateur_id' => $utilisateurId]);

        $emotion = $stmt->fetch();
        return $emotion ?: null;
    }

    /**
     * Retourne les emotions des 7 derniers jours
     */
    public function getLast7Days(int $utilisateurId): array
    {
        $sql = "SELECT *
                FROM emotions
                WHERE utilisateur_id = :utilisateur_id
                  AND date_enregistrement >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                ORDER BY date_enregistrement ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':utilisateur_id' => $utilisateurId]);

        return $stmt->fetchAll();
    }

    /**
     * Retourne les emotions des 30 derniers jours
     */
    public function getLast30Days(int $utilisateurId): array
    {
        $sql = "SELECT *
                FROM emotions
                WHERE utilisateur_id = :utilisateur_id
                  AND date_enregistrement >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                ORDER BY date_enregistrement ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':utilisateur_id' => $utilisateurId]);

        return $stmt->fetchAll();
    }

    /**
     * Nombre total d'emotions pour un utilisateur
     */
    public function countByUser(int $utilisateurId): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM emotions
                WHERE utilisateur_id = :utilisateur_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':utilisateur_id' => $utilisateurId]);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }

    /**
     * Repartition des emotions d'un utilisateur
     */
    public function getDistributionByUser(int $utilisateurId): array
    {
        $sql = "SELECT humeur, COUNT(*) AS total
                FROM emotions
                WHERE utilisateur_id = :utilisateur_id
                GROUP BY humeur
                ORDER BY total DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':utilisateur_id' => $utilisateurId]);

        return $stmt->fetchAll();
    }

    /**
     * Evolution quotidienne du stress
     */
    public function getStressEvolution(int $utilisateurId, int $days = 7): array
    {
        $sql = "SELECT
                    DATE(date_enregistrement) AS jour,
                    AVG(
                        CASE
                            WHEN humeur = 'tres_heureux' THEN 1
                            WHEN humeur = 'heureux' THEN 2
                            WHEN humeur = 'neutre' THEN 3
                            WHEN humeur = 'stresse' THEN 4
                            WHEN humeur = 'tres_stresse' THEN 5
                            ELSE 3
                        END
                    ) AS niveau_moyen
                FROM emotions
                WHERE utilisateur_id = :utilisateur_id
                  AND date_enregistrement >= DATE_SUB(NOW(), INTERVAL :jours DAY)
                GROUP BY DATE(date_enregistrement)
                ORDER BY jour ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->bindValue(':jours', $days, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Statistiques globales emotions
     */
    public function getGlobalStats(): array
    {
        $sql = "SELECT
                    COUNT(*) AS total_emotions,
                    humeur,
                    COUNT(humeur) AS nombre
                FROM emotions
                GROUP BY humeur";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
