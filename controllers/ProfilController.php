<?php
/**
 * Controleur du profil utilisateur
 */

class ProfilController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Affiche le profil
     */
    public function index(): void
    {
        requireLogin();

        $user = $this->userModel->findById(getUserId());

        view('profil.index', [
            'pageTitle' => 'Mon profil',
            'profil' => $user
        ]);
    }

    /**
     * Met a jour le profil
     */
    public function update(): void
    {
        requireLogin();
        validateCsrf();

        $id = getUserId();
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (mb_strlen($nom) < 2) {
            setFlash('error', 'Le nom doit contenir au moins 2 caracteres.');
            redirect('/profil');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            setFlash('error', 'Adresse email invalide.');
            redirect('/profil');
        }

        if ($this->userModel->emailExists($email, $id)) {
            setFlash('error', 'Cette adresse email est deja utilisee.');
            redirect('/profil');
        }

        $updated = $this->userModel->updateProfile($id, $nom, $email);

        if (!$updated) {
            setFlash('error', 'Impossible de mettre a jour le profil.');
            redirect('/profil');
        }

        $_SESSION['user_nom'] = $nom;
        $_SESSION['user_email'] = $email;

        setFlash('success', 'Profil mis a jour avec succes.');
        redirect('/profil');
    }

    /**
     * Met a jour le mot de passe
     */
    public function updatePassword(): void
    {
        requireLogin();
        validateCsrf();

        $id = getUserId();
        $currentPassword = $_POST['mot_de_passe_actuel'] ?? '';
        $newPassword = $_POST['nouveau_mot_de_passe'] ?? '';
        $confirmPassword = $_POST['confirmation_nouveau_mot_de_passe'] ?? '';

        $user = $this->userModel->findById($id);

        if (!$user || !password_verify($currentPassword, $user['mot_de_passe'])) {
            setFlash('error', 'Mot de passe actuel incorrect.');
            redirect('/profil');
        }

        if (strlen($newPassword) < PASSWORD_MIN_LENGTH) {
            setFlash('error', 'Le nouveau mot de passe doit contenir au moins ' . PASSWORD_MIN_LENGTH . ' caracteres.');
            redirect('/profil');
        }

        if ($newPassword !== $confirmPassword) {
            setFlash('error', 'La confirmation du mot de passe ne correspond pas.');
            redirect('/profil');
        }

        $updated = $this->userModel->updatePassword($id, $newPassword);

        if (!$updated) {
            setFlash('error', 'Impossible de modifier le mot de passe.');
            redirect('/profil');
        }

        setFlash('success', 'Mot de passe modifie avec succes.');
        redirect('/profil');
    }
}
