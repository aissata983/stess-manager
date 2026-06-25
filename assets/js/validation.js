document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');

    if (registerForm) {
        registerForm.addEventListener('submit', (event) => {
            const password = document.getElementById('mot_de_passe')?.value || '';
            const confirmPassword = document.getElementById('confirmation_mot_de_passe')?.value || '';
            const email = document.getElementById('email')?.value || '';
            const nom = document.getElementById('nom')?.value || '';

            if (nom.trim().length < 2) {
                event.preventDefault();
                alert('Le nom doit contenir au moins 2 caracteres.');
                return;
            }

            if (!validateEmail(email)) {
                event.preventDefault();
                alert('Veuillez saisir une adresse email valide.');
                return;
            }

            if (password.length < 8) {
                event.preventDefault();
                alert('Le mot de passe doit contenir au moins 8 caracteres.');
                return;
            }

            if (password !== confirmPassword) {
                event.preventDefault();
                alert('Les mots de passe ne correspondent pas.');
            }
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', (event) => {
            const email = document.getElementById('email')?.value || '';
            const password = document.getElementById('mot_de_passe')?.value || '';

            if (!validateEmail(email)) {
                event.preventDefault();
                alert('Adresse email invalide.');
                return;
            }

            if (password.trim() === '') {
                event.preventDefault();
                alert('Le mot de passe est obligatoire.');
            }
        });
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
});
