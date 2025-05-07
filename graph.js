
const ctx = document.getElementById('graph').getContext('2d');
const walletChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['','','','','','','','','','','',''],
        datasets: [{
            label: '',
            data: [NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN],
            borderColor: 'rgb(133,255,118)',
            backgroundColor: 'rgba(112,181,100,0.03)',
            fill: true,
            tension: 0.1 // Smooth the line
        }]
    },
    options: {
        scales: {
            x: {
                ticks: {
                    maxRotation: 45,
                    minRotation: 45,
                    align: 'start'
                },

                title: {
                    display: true,
                    text: 'Date'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Balance'
                },
                beginAtZero: true
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

const updateChart = () =>
{
    walletChart.data.datasets[0].data.shift();
    walletChart.data.datasets[0].data.push(TOTAL_WALLET)

    walletChart.data.labels.shift();
    walletChart.data.labels.push(SESSION_DATA['logged'].gameDate.toLocaleDateString('fr-FR'));
    walletChart.update();
};