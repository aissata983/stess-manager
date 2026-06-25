document.addEventListener('DOMContentLoaded', () => {
    const textColor = getComputedStyle(document.body).getPropertyValue('--text-color').trim();
    const mutedColor = getComputedStyle(document.body).getPropertyValue('--text-muted').trim();

    const defaultOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    color: textColor
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: mutedColor
                },
                grid: {
                    color: 'rgba(148, 163, 184, 0.15)'
                }
            },
            y: {
                ticks: {
                    color: mutedColor
                },
                grid: {
                    color: 'rgba(148, 163, 184, 0.15)'
                }
            }
        }
    };

    function parseJsonData(value) {
        try {
            return JSON.parse(value || '[]');
        } catch (error) {
            return [];
        }
    }

    function createLineChart(id, label, borderColor, backgroundColor) {
        const canvas = document.getElementById(id);
        if (!canvas) return;

        const labels = parseJsonData(canvas.dataset.labels);
        const values = parseJsonData(canvas.dataset.values);

        new Chart(canvas, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label,
                    data: values,
                    borderColor,
                    backgroundColor,
                    tension: 0.35,
                    fill: true
                }]
            },
            options: defaultOptions
        });
    }

    function createBarChart(id, label, backgroundColor) {
        const canvas = document.getElementById(id);
        if (!canvas) return;

        const labels = parseJsonData(canvas.dataset.labels);
        const values = parseJsonData(canvas.dataset.values);

        new Chart(canvas, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label,
                    data: values,
                    backgroundColor
                }]
            },
            options: defaultOptions
        });
    }

    function createDoughnutChart(id, colors) {
        const canvas = document.getElementById(id);
        if (!canvas) return;

        const labels = parseJsonData(canvas.dataset.labels);
        const values = parseJsonData(canvas.dataset.values);

        new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: colors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor
                        }
                    }
                }
            }
        });
    }

    createLineChart(
        'stressEvolutionChart',
        'Evolution du stress',
        '#4f46e5',
        'rgba(79, 70, 229, 0.18)'
    );

    createLineChart(
        'fullStressEvolutionChart',
        'Niveau moyen de stress',
        '#06b6d4',
        'rgba(6, 182, 212, 0.18)'
    );

    createBarChart(
        'exerciseStatsChart',
        'Exercices realises',
        'rgba(16, 185, 129, 0.7)'
    );

    createBarChart(
        'meditationStatsChart',
        'Meditations realisees',
        'rgba(139, 92, 246, 0.7)'
    );

    createDoughnutChart(
        'emotionDistributionChart',
        ['#22c55e', '#84cc16', '#facc15', '#fb923c', '#ef4444']
    );

    createDoughnutChart(
        'adminEmotionChart',
        ['#22c55e', '#84cc16', '#facc15', '#fb923c', '#ef4444']
    );
});
