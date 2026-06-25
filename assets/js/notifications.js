document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach((alertBox) => {
        setTimeout(() => {
            alertBox.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            alertBox.style.opacity = '0';
            alertBox.style.transform = 'translateY(-10px)';

            setTimeout(() => {
                if (alertBox.parentNode) {
                    alertBox.parentNode.removeChild(alertBox);
                }
            }, 400);
        }, 5000);
    });
});
