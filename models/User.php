<?php
/**
 * Modele utilisateur
 */

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create(string $nom, string $email, string $motDePasse, string $role = 'user'): bool
    {
        $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe, role, date_creation)
                VALUES (:nom, :email, :mot_de_passe, :role, NOW())";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':mot_de_passe' => password_hash($motDePasse, PASSWORD_DEFAULT),
            ':role' => $role
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM utilisateurs WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function authenticate(string $email, string $motDePasse): ?array
    {
        $user = $this->findByEmail($email);

        if ($user && password_verify($motDePasse, $user['mot_de_passe'])) {
            $this->updateLastLogin((int) $user['id']);
            return $user;
        }

        return null;
    }

    public function updateLastLogin(int $id): bool
    {
        $sql = "UPDATE utilisateurs SET derniere_connexion = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }

    public function updateProfile(int $id, string $nom, string $email): bool
    {
        $sql = "UPDATE utilisateurs
                SET nom = :nom, email = :email, date_modification = NOW()
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':email' => $email
        ]);
    }

    public function updatePassword(int $id, string $newPassword): bool
    {
        $sql = "UPDATE utilisateurs
                SET mot_de_passe = :mot_de_passe, date_modification = NOW()
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':mot_de_passe' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM utilisateurs WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }

    public function getAll(): array
    {
        $sql = "SELECT id, nom, email, role, date_creation, derniere_connexion, actif
                FROM utilisateurs
                ORDER BY date_creation DESC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function countAll(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM utilisateurs";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        if ($excludeId) {
            $sql = "SELECT id FROM utilisateurs WHERE email = :email AND id != :exclude_id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':email' => $email,
                ':exclude_id' => $excludeId
            ]);
        } else {
            $sql = "SELECT id FROM utilisateurs WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':email' => $email]);
        }

        return (bool) $stmt->fetch();
    }

    public function getGlobalStats(): array
    {
        $sql = "SELECT
                    COUNT(*) AS total_utilisateurs,
                    SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) AS total_admins,
                    SUM(CASE WHEN role = 'user' THEN 1 ELSE 0 END) AS total_users
                FROM utilisateurs";

        $stmt = $this->db->query($sql);
        return $stmt->fetch() ?: [];
    }
}
