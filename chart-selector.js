async function chart_selector_init_func(e, i)
{

    const el = document.createElement('span');
    const lbl = document.createElement('label');
    const select = document.createElement('select');

    lbl.setAttribute('for', `actionSelect-${i+1}`);
    lbl.innerText = 'Action: ';

    select.id = `actionSelect-${i+1}`;

    const actions = await getData('all-actions');
    actions.forEach(f => {
        select.add(new Option(f.name, f.code));
    });

    el.appendChild(lbl);
    el.appendChild(select);
    e.appendChild(el);
    e.addEventListener('change', () => {
        graphAct[i].data.datasets[0].data = previous12.get(select.value);
        graphAct[i].update();
    });
}
function chart_selector_init()
{
    const chartList = document.querySelectorAll('.chart-container');
    chartList.forEach((e, i) => chart_selector_init_func(e, i));
}

const get_chart_selector_id = () =>
{
 return [
     document.getElementById('actionSelect-1').value,
    document.getElementById('actionSelect-2').value,
    document.getElementById('actionSelect-3').value,
 ];
}

