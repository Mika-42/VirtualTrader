let previous12 = new Map;
const updatePrices = (price, old_evolution) => {

    const variation = (Math.random() * 6) - 3; // [-3, 3]

    let evolution = parseFloat(old_evolution) + variation;

    evolution = Math.max(-10, Math.min(10, evolution));

    let p = parseFloat(price) * (1 + evolution / 100);

    p = Math.max(1, p);

    return {
        price: Math.round(p * 100) / 100,
        evolution: Math.round(evolution * 100) / 100
    };
}

const action_update = () =>
{
    SESSION_DATA['actions'].forEach(e => {
        const price = document.querySelector(`#${e.code} .action-price`);
        const evolution = document.querySelector(`#${e.code} .action-price-evolution`);

        let _ = updatePrices(e.value, e.evolution);
        e.value = _.price;
        e.evolution = _.evolution;
        price.innerText = `${e.value}€`;
        evolution.innerText = `${(e.evolution >= 0) ? '+' : '-'}${Math.abs(e.evolution)}%`;

        previous12.get(e.code).push(e.value);
        previous12.get(e.code).shift();
    });


}
const actions_init = () =>
{
    const pid = 'action-panel';

    SESSION_DATA['actions'].forEach(e =>
    {
        let el = document.createElement('div');
        el.className = 'action';
        el.id = e.code;

        el.innerHTML = `
                <div class="action-name">${e.name}</div>
                <div class="action-code">(${e.code})</div>
                <div class="action-price">${e.value}€</div>
                <div class="action-price-evolution">${(e.evolution >= 0) ? '+' : '-'}${Math.abs(e.evolution) + '%'}</div>
                <button class="action-buy" title="buy"></button>
                <button disabled class="action-sell" title="sell"></button>
                <div class="action-description">${e.description}</div>
            `;

        let p = document.getElementById(pid);
        p.appendChild(el);

        const btnSell = el.querySelector(`.action-sell`);
        const btnBuy = el.querySelector(`.action-buy`);

        btnSell.addEventListener('click', () => {
            btnSell.disabled = true;
            btnBuy.disabled = false;

            userActionsCodes = userActionsCodes.filter(f => {
                return f !== e.code;
            });
            SESSION_DATA['logged'].balance += parseFloat(e.value);
            balance_update();
        });

        btnBuy.addEventListener('click', () => {
            if(parseFloat(e.value) <= TOTAL_WALLET)
            {
            btnSell.disabled = false;
            btnBuy.disabled = true;

            userActionsCodes.push(e.code);
            SESSION_DATA['logged'].balance -= parseFloat(e.value);
            balance_update();
            }
        });

        previous12.set(e.code,[NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN]);
    });
}


