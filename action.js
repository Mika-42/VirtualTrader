let previous12 = new Map; //todo remove later

async function ui_action_update()
{
    const actions = await getData('all-actions');

    actions.forEach(e => {
        const price = document.querySelector(`#${e.code} .action-price`);
        const evolution = document.querySelector(`#${e.code} .action-price-evolution`);

        let _ = updatePrices(e.value, e.evolution);
        price.innerText = `${_.price}€`;
        evolution.innerText = `${(_.evolution >= 0) ? '+' : '-'}${Math.abs(_.evolution)}%`;

        previous12.get(e.code).push(_.price);
        previous12.get(e.code).shift();
    });
}

async function actions_init()
{
    const pid = 'action-panel';

    const actions = await getData('all-actions');

    actions.forEach(action =>
    {

        const htmlObj = create_action_html(pid, action);

        const btnSell = htmlObj.querySelector(`.action-sell`);
        const btnBuy = htmlObj.querySelector(`.action-buy`);

        btnSell.addEventListener('click', async () => await sell_callback(btnSell, btnBuy, action));
        btnBuy.addEventListener('click', async () => await buy_callback(btnSell, btnBuy, action));

        //todo add to table
        previous12.set(action.code,[NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN,NaN]);
    });
}


