document.addEventListener('DOMContentLoaded', () => {
    const session = document.querySelector('.meditation-session');
    if (!session) return;

    const timerElement = document.getElementById('meditationTimer');
    const startBtn = document.getElementById('startMeditationBtn');
    const resetBtn = document.getElementById('resetMeditationBtn');
    const completeForm = document.getElementById('meditationCompleteForm');
    const hiddenDuration = document.getElementById('duree_reelle_minutes');

    const totalMinutes = parseInt(session.dataset.minutes || '5', 10);
    const totalSeconds = totalMinutes * 60;

    let remaining = totalSeconds;
    let interval = null;
    let isRunning = false;

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }

    function updateDisplay() {
        timerElement.textContent = formatTime(remaining);
    }

    function startMeditation() {
        if (isRunning) return;

        isRunning = true;
        document.body.classList.add('meditation-focus');

        interval = setInterval(() => {
            remaining--;
            updateDisplay();

            const elapsedMinutes = Math.ceil((totalSeconds - remaining) / 60);
            hiddenDuration.value = elapsedMinutes > 0 ? elapsedMinutes : 0;

            if (remaining <= 0) {
                clearInterval(interval);
                isRunning = false;
                timerElement.textContent = 'Session terminee';
                document.body.classList.remove('meditation-focus');

                setTimeout(() => {
                    if (completeForm) {
                        completeForm.submit();
                    }
                }, 1000);
            }
        }, 1000);
    }

    function resetMeditation() {
        clearInterval(interval);
        isRunning = false;
        remaining = totalSeconds;
        hiddenDuration.value = 0;
        updateDisplay();
        document.body.classList.remove('meditation-focus');
    }

    startBtn?.addEventListener('click', startMeditation);
    resetBtn?.addEventListener('click', resetMeditation);

    updateDisplay();
});
