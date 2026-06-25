<?php
/**
 * Modele historique des meditations
 */

class HistoriqueMeditation
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Enregistre la realisation d'une meditation
     */
    public function create(
        int $utilisateurId,
        int $meditationId,
        ?int $dureeReelleMinutes = null,
        int $complete = 1,
        ?int $note = null,
        ?string $ressenti = null
    ): bool {
        $sql = "INSERT INTO historique_meditations
                (utilisateur_id, meditation_id, duree_reelle_minutes, complete, note, ressenti, date_realisation)
                VALUES
                (:utilisateur_id, :meditation_id, :duree_reelle_minutes, :complete, :note, :ressenti, NOW())";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':utilisateur_id' => $utilisateurId,
            ':meditation_id' => $meditationId,
            ':duree_reelle_minutes' => $dureeReelleMinutes,
            ':complete' => $complete,
            ':note' => $note,
            ':ressenti' => $ressenti
        ]);
    }

    /**
     * Retourne l'historique des meditations d'un utilisateur
     */
    public function getByUser(int $utilisateurId, int $limit = 20): array
    {
        $sql = "SELECT hm.*, m.titre, m.slug, m.description
                FROM historique_meditations hm
                INNER JOIN meditations m ON hm.meditation_id = m.id
                WHERE hm.utilisateur_id = :utilisateur_id
                ORDER BY hm.date_realisation DESC
                LIMIT :limite";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->bindValue(':limite', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Nombre total de meditations realisees
     */
    public function countByUser(int $utilisateurId): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM historique_meditations
                WHERE utilisateur_id = :utilisateur_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':utilisateur_id' => $utilisateurId]);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }

    /**
     * Nombre de meditations sur les 30 derniers jours
     */
    public function countLast30Days(int $utilisateurId): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM historique_meditations
                WHERE utilisateur_id = :utilisateur_id
                  AND date_realisation >= DATE_SUB(NOW(), INTERVAL 30 DAY)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':utilisateur_id' => $utilisateurId]);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }

    /**
     * Evolution journaliere des meditations
     */
    public function getDailyStats(int $utilisateurId, int $days = 30): array
    {
        $sql = "SELECT
                    DATE(date_realisation) AS jour,
                    COUNT(*) AS total
                FROM historique_meditations
                WHERE utilisateur_id = :utilisateur_id
                  AND date_realisation >= DATE_SUB(NOW(), INTERVAL :jours DAY)
                GROUP BY DATE(date_realisation)
                ORDER BY jour ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->bindValue(':jours', $days, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Statistiques globales
     */
    public function getGlobalStats(): array
    {
        $sql = "SELECT COUNT(*) AS total_realisees FROM historique_meditations";
        $stmt = $this->db->query($sql);

        return $stmt->fetch() ?: [];
    }
}
