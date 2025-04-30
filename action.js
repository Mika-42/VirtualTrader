const updateActionsInHTML = (data) =>
{
    data['actions'].forEach(e => {
        const price = document.querySelector(`#${e.code} .action-price`);
        const evolution = document.querySelector(`#${e.code} .action-price`);
        const btnSell = document.querySelector(`#${e.code} .action-sell`);
        const btnBuy = document.querySelector(`#${e.code} .action-buy`);

        price.innerText = `${e.value}€`;
        evolution.innerText `${(e.evolution >= 0) ? '+' : '-'}${Math.abs(e.evolution)}'%'`;

        btnSell.addEventListener('click', () => {
            btnSell.disabled = true;
            btnBuy.disabled = false;
            balanceAccountValue += parseFloat(e.value);
            balanceAccount.innerText = formatBalanceAccount(balanceAccountValue);
        });

        btnBuy.addEventListener('click', () => {
            btnSell.disabled = false;
            btnBuy.disabled = true;
            balanceAccountValue -= parseFloat(e.value);
            balanceAccount.innerText = formatBalanceAccount(balanceAccountValue);
        });
    });
}
const addActionsToHTML = (data) =>
{
    let evolution = 5; // todo replace this variable by e.evolution

    const pid = 'action-panel';

    data['actions'].forEach(e =>
    {
        let el = document.createElement('div');
        el.className = 'action';
        el.id = e.code;

        el.innerHTML = `
                <div class="action-name">${e.name}</div>
                <div class="action-code">(${e.code})</div>
                <div class="action-price">${e.value}€</div>
                <div class="action-price-evolution">${(evolution >= 0) ? '+' : '-'}${Math.abs(evolution) + '%'}</div>
                <button class="action-buy" title="buy"></button>
                <button disabled class="action-sell" title="sell"></button>
                <div class="action-description">${e.description}</div>
            `;

        let p = document.getElementById(pid);
        p.appendChild(el);
    });
}
const updatePrices = () => {

    let price = 0, old_evolution = 0;

    const variation = (Math.random() * 6) - 3; // [-3, 3]

    let evolution = old_evolution + variation;

    evolution = Math.max(-10, Math.min(10, evolution));

    let p = price * (1 + evolution / 100);

    p = Math.max(1, p);

    return {
        price: Math.round(p * 100) / 100,
        evolution: Math.round(evolution * 100) / 100
    };
}

//----
getFromPHP(addActionsToHTML);
getFromPHP(updateActionsInHTML);