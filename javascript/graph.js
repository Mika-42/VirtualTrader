
const ctx = document.getElementById('graph').getContext('2d');
const walletChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: Array(12).fill(''),
        datasets: [{
            label: '',
            data: Array(12).fill(NaN),
            borderColor: 'rgb(133,255,118)',
            backgroundColor: 'rgba(112,181,100,0.09)',
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
                min: 1000,
                ticks: {
                    stepSize: 5000
                },
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

function updateChart(data)
{
    walletChart.data.datasets[0].data.shift();

    walletChart.data.datasets[0].data.push(data.wallet)

    walletChart.data.labels.shift();

    walletChart.data.labels.push(new Date(data.date).toLocaleDateString('fr-FR'));
    walletChart.update();
}