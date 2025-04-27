
const graphActEl = [
    document.getElementById('action-chart-1').getContext('2d'),
    document.getElementById('action-chart-2').getContext('2d'),
    document.getElementById('action-chart-3').getContext('2d')
]

let graphAct = [];

const newChart = (g) => {
    return new Chart(g, {
        type: 'line',
        data: {
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', ''],
            datasets: [{
                label: '',
                data: [NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN],
                borderColor: 'rgb(255,159,34)',
                backgroundColor: 'rgba(112,181,100,0.03)',
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
};

for(let i = 0; i < 3; ++i)
{
    graphAct[i] = newChart(graphActEl[i]);
}

const updateActionsChart = (actionGraph, v_date, v_balance) =>
{
    let i = v_date.getMonth();

    actionGraph.data.datasets[0].data[i] = v_balance;
    actionGraph.data.labels[i] = v_date.toLocaleDateString('fr-FR');
    actionGraph.update();
};