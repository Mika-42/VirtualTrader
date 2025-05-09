function shiftLeft(arr, n) {
    for (let i = 0; i < n; i++) {
        arr.push(arr.shift());
    }
    return arr;
}

function chart_selector_init_func(chart, i, data)
{
    const el = document.createElement('span');
    const lbl = document.createElement('label');
    const select = document.createElement('select');

    lbl.setAttribute('for', `actionSelect-${i+1}`);
    lbl.innerText = 'Action: ';

    select.id = `actionSelect-${i+1}`;

    data.actions.forEach(f => {
        select.add(new Option(f.name, f.code));
    });

    el.appendChild(lbl);
    el.appendChild(select);
    chart.appendChild(el);
    chart.addEventListener('change', () => {
        graphAct[i].data.datasets[0].data = Array(12).fill(NaN);
    });
}
function chart_selector_init(data)
{
    const chartList = document.querySelectorAll('.chart-container');

    chartList.forEach((chart, i) => chart_selector_init_func(chart, i, data));
}

const get_chart_selector_id = () =>
{
 return [
     document.getElementById('actionSelect-1').value,
    document.getElementById('actionSelect-2').value,
    document.getElementById('actionSelect-3').value,
 ];
}

