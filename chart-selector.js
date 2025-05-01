const chart_selector_init = () => {

    document.querySelectorAll('.chart-container').forEach((e, i) => {

        const el = document.createElement('span');
        const lbl = document.createElement('label');
        const select = document.createElement('select');

        lbl.setAttribute('for', `actionSelect-${i+1}`);
        lbl.innerText = 'Action: ';

        select.id = `actionSelect-${i+1}`;

        SESSION_DATA['actions'].forEach(f => {
            select.add(new Option(f.name, f.code));
        });

        el.appendChild(lbl);
        el.appendChild(select);
        e.appendChild(el);
        e.addEventListener('change', () => {
            graphAct[i].data.datasets[0].data = previous12.get(select.value);
            graphAct[i].update();
        });
    });

}

const get_chart_selector_id = () =>
{
 return [
     document.getElementById('actionSelect-1').value,
    document.getElementById('actionSelect-2').value,
    document.getElementById('actionSelect-3').value,
 ];
}

