<?php
/**
 * Modele historique des exercices
 */

class HistoriqueExercice
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Enregistre la realisation d'un exercice
     */
    public function create(
        int $utilisateurId,
        int $exerciceId,
        ?int $dureeReelle = null,
        int $complete = 1,
        ?int $note = null,
        ?string $ressenti = null
    ): bool {
        $sql = "INSERT INTO historique_exercices
                (utilisateur_id, exercice_id, duree_reelle_secondes, complete, note, ressenti, date_realisation)
                VALUES
                (:utilisateur_id, :exercice_id, :duree_reelle_secondes, :complete, :note, :ressenti, NOW())";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':utilisateur_id' => $utilisateurId,
            ':exercice_id' => $exerciceId,
            ':duree_reelle_secondes' => $dureeReelle,
            ':complete' => $complete,
            ':note' => $note,
            ':ressenti' => $ressenti
        ]);
    }

    /**
     * Retourne l'historique des exercices d'un utilisateur
     */
    public function getByUser(int $utilisateurId, int $limit = 20): array
    {
        $sql = "SELECT he.*, e.titre, e.slug, e.description
                FROM historique_exercices he
                INNER JOIN exercices e ON he.exercice_id = e.id
                WHERE he.utilisateur_id = :utilisateur_id
                ORDER BY he.date_realisation DESC
                LIMIT :limite";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':utilisateur_id', $utilisateurId, PDO::PARAM_INT);
        $stmt->bindValue(':limite', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Nombre d'exercices realises par un utilisateur
     */
    public function countByUser(int $utilisateurId): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM historique_exercices
                WHERE utilisateur_id = :utilisateur_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':utilisateur_id' => $utilisateurId]);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }

    /**
     * Nombre d'exercices realises sur 7 jours
     */
    public function countLast7Days(int $utilisateurId): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM historique_exercices
                WHERE utilisateur_id = :utilisateur_id
                  AND date_realisation >= DATE_SUB(NOW(), INTERVAL 7 DAY)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':utilisateur_id' => $utilisateurId]);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }

    /**
     * Evolution journaliere du nombre d'exercices
     */
    public function getDailyStats(int $utilisateurId, int $days = 7): array
    {
        $sql = "SELECT
                    DATE(date_realisation) AS jour,
                    COUNT(*) AS total
                FROM historique_exercices
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
        $sql = "SELECT COUNT(*) AS total_realises FROM historique_exercices";
        $stmt = $this->db->query($sql);

        return $stmt->fetch() ?: [];
    }
}
