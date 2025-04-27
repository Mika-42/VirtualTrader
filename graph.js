
// Create the chart
const ctx = document.getElementById('graph').getContext('2d');
const walletChart = new Chart(ctx, {
    type: 'line', // Line chart
    data: {
        labels: ['','','','','','','','','','','','',''],
        datasets: [{
            label: '',
            data: [NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN],
            borderColor: 'rgb(133,255,118)',
            backgroundColor: 'rgb(112,181,100)',
            fill: true,
            tension: 0.1 // Smooth the line
        }]
    },
    options: {
        scales: {
            x: {
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

const updateChart = (v_date, v_balance) =>
{
    let i = v_date.getMonth();

    walletChart.data.datasets[0].data[i] = v_balance;
    walletChart.data.labels[i] = v_date.toLocaleDateString('fr-FR');
    walletChart.update();
};