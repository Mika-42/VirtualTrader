
const graphActEl = [
    document.getElementById('action-chart-1').getContext('2d'),
    document.getElementById('action-chart-2').getContext('2d'),
    document.getElementById('action-chart-3').getContext('2d')
]

let graphAct = [];

const newChart = (g) => {
    return new Chart(g, {
        type: 'bar',
        data: {
            labels: ['', '', '', '', '', '', '', '', '', '', '', ''],
            datasets: [{
                label: '',
                data: [NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN, NaN],
                borderColor: 'rgb(255,159,34)',
                backgroundColor: 'rgba(255,238,0,0.84)',
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

const updateActionsChart = (v_date) =>
{
    const codes = get_chart_selector_id();

    graphAct.forEach((f, i) => {
        f.data.datasets[0].data = previous12.get(codes[i]);

        f.data.labels.push(v_date.toLocaleDateString('fr-FR'));
        f.data.labels.shift();
        f.update();
    });
};
