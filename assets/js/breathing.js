document.addEventListener('DOMContentLoaded', () => {
    const app = document.querySelector('.breathing-app');
    if (!app) return;

    const circle = document.getElementById('breathingCircle');
    const phaseLabel = document.getElementById('breathingPhase');
    const timerLabel = document.getElementById('breathingTimer');
    const startBtn = document.getElementById('startBreathingBtn');
    const resetBtn = document.getElementById('resetBreathingBtn');
    const hiddenDuration = document.getElementById('duree_reelle_secondes');
    const completeForm = document.getElementById('exerciseCompleteForm');

    const totalDuration = parseInt(app.dataset.duration || '240', 10);
    const inspire = parseInt(app.dataset.inspire || '4', 10);
    const holdHigh = parseInt(app.dataset.holdHigh || '0', 10);
    const expire = parseInt(app.dataset.expire || '4', 10);
    const holdLow = parseInt(app.dataset.holdLow || '0', 10);

    let elapsed = 0;
    let phaseTime = 0;
    let currentPhase = 0;
    let isRunning = false;
    let mainInterval = null;

    const phases = [
        { name: 'Inspirez', className: 'inhale', duration: inspire },
        { name: 'Retenez', className: 'hold', duration: holdHigh },
        { name: 'Expirez', className: 'exhale', duration: expire },
        { name: 'Retenez', className: 'hold', duration: holdLow }
    ].filter((phase) => phase.duration > 0);

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }

    function updatePhaseDisplay() {
        const phase = phases[currentPhase];
        phaseLabel.textContent = phase.name;
        circle.classList.remove('inhale', 'hold', 'exhale');
        circle.classList.add(phase.className, 'active');
    }

    function startExercise() {
        if (isRunning) return;

        isRunning = true;
        updatePhaseDisplay();

        mainInterval = setInterval(() => {
            elapsed++;
            phaseTime++;

            const remaining = Math.max(totalDuration - elapsed, 0);
            timerLabel.textContent = formatTime(remaining);
            hiddenDuration.value = elapsed;

            if (phaseTime >= phases[currentPhase].duration) {
                phaseTime = 0;
                currentPhase = (currentPhase + 1) % phases.length;
                updatePhaseDisplay();
            }

            if (elapsed >= totalDuration) {
                stopExercise(true);
            }
        }, 1000);
    }

    function stopExercise(autoSubmit = false) {
        clearInterval(mainInterval);
        isRunning = false;
        circle.classList.remove('active', 'inhale', 'hold', 'exhale');
        phaseLabel.textContent = 'Termine';

        if (autoSubmit && completeForm) {
            setTimeout(() => {
                completeForm.submit();
            }, 800);
        }
    }

    function resetExercise() {
        clearInterval(mainInterval);
        isRunning = false;
        elapsed = 0;
        phaseTime = 0;
        currentPhase = 0;
        hiddenDuration.value = 0;
        timerLabel.textContent = formatTime(totalDuration);
        phaseLabel.textContent = 'Pret';
        circle.classList.remove('active', 'inhale', 'hold', 'exhale');
    }

    startBtn?.addEventListener('click', startExercise);
    resetBtn?.addEventListener('click', resetExercise);

    resetExercise();
});
