function init_actions(data) {

    data.actions.forEach((action) => {
        const htmlObj = document.createElement('div');
        htmlObj.className = 'action';
        htmlObj.id = action.code;

        htmlObj.innerHTML = `
            <div class="action-name">${action.name}</div>
            <div class="action-code">(${action.code})</div>
            <div class="action-price">${format_wallet(action.value)}</div>
            <div class="action-price-evolution">${(action.evolution >= 0) ? '+' : '-'}${Math.abs(action.evolution) + '%'}</div>
            <button class="action-buy" title="buy"></button>
            <button disabled class="action-sell" title="sell"></button>
            <div class="action-description">${action.description}</div>
        `;

        const btnSell = htmlObj.querySelector(`.action-sell`);
        const btnBuy = htmlObj.querySelector(`.action-buy`);

        btnSell.addEventListener('click', () => {

            fetch(`fetch.php?action=sell&action_code=${action.code}`)
                .then(response => response.json())
                .then(data => {
                    btnSell.disabled = true;
                    btnBuy.disabled = false;
                    update_wallet(data);
                }).catch(err => console.error('Fetch error on sell: ', err));

        });

        btnBuy.addEventListener('click', () => {

            fetch(`fetch.php?action=buy&action_code=${action.code}`)
                .then(response => response.json())
                .then(data => {

                    if(data.can_be_buy) {
                        btnSell.disabled = false;
                        btnBuy.disabled = true;
                        update_wallet(data);
                    }

                }).catch(err => console.error('Fetch error on sell: ', err));

        });

        document.getElementById('action-panel').appendChild(htmlObj);
    });
}

function update_actions(actions)
{
    actions.forEach(action => {
        const price = document.querySelector(`#${action.code} .action-price`);
        const evolution = document.querySelector(`#${action.code} .action-price-evolution`);

        price.innerText = format_wallet(action.value);
        evolution.innerText = `${(action.evolution >= 0) ? '+' : '-'}${Math.abs(action.evolution)}%`;
    });
}