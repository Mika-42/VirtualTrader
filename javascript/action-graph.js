
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
            labels: Array(12).fill(''),
            datasets: [{
                label: '',
                data: Array(12).fill(NaN),
                borderColor: '#4caf50',
                backgroundColor: 'rgba(76,175,80,0.56)',
                borderRadius: 5,
                hoverBackgroundColor: '#399a3d',
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
                        text: ''
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


function update_actions_chart(data)
{
    const codes = get_chart_selector_id();

    graphAct.forEach((chart, i) => {

        chart.data.labels.push(new Date(data.date).toLocaleDateString('fr-FR'));
        chart.data.labels.shift();

        chart.data.datasets[0].data[0] = Array.from(data.actions).filter(e => e.code === codes[i])[0].value;
        chart.data.datasets[0].data.push(chart.data.datasets[0].data.shift()) //;
        ;

        chart.update();
    });
}
