const chart_selector_init = () => {

    document.querySelectorAll('.chart-container').forEach((e, i) => {

        const el = document.createElement('span');
        const lbl = document.createElement('label');
        const select = document.createElement('select');

        lbl.setAttribute('for', `actionSelect-${i+1}`);
        lbl.innerText = 'Action: ';

        select.id = `actionSelect-${i+1}`;

        SESSION_DATA['actions'].forEach(e => {
            select.add(new Option(e.name, e.code));
        });

        el.appendChild(lbl);
        el.appendChild(select);
        e.appendChild(el);
        });

}