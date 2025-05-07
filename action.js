let previous12 = new Map; //todo remove later
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

async function action_update()
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

        setData('update-actions', {value: _.price, evolution: _.evolution, code: e.code});

        //todo set history
    });
}

//-----------------------------//
function create_action_html(parentID, actionData) {
    const htmlObj = document.createElement('div');
    htmlObj.className = 'action';
    htmlObj.id = actionData.code;

    htmlObj.innerHTML = `
            <div class="action-name">${actionData.name}</div>
            <div class="action-code">(${actionData.code})</div>
            <div class="action-price">${actionData.value}€</div>
            <div class="action-price-evolution">${(actionData.evolution >= 0) ? '+' : '-'}${Math.abs(actionData.evolution) + '%'}</div>
            <button class="action-buy" title="buy"></button>
            <button disabled class="action-sell" title="sell"></button>
            <div class="action-description">${actionData.description}</div>
        `;
    let p = document.getElementById(parentID);
    p.appendChild(htmlObj);

    return htmlObj;
}

async function sell_callback(sellButton, buyButton, action)
{
    sellButton.disabled = true;
    buyButton.disabled = false;

    const logged = await getData('logged-user');

    setData('remove-action-to', {actionCode: action.code, playerId: logged.id});

    setData('update-logged-wallet', {
        balance: logged.balance + parseFloat(action.value),
        id: logged.id}
    );

    await balance_update();
}

async function buy_callback(sellButton, buyButton, action)
{
    const logged = await getData('logged-user');

    if(parseFloat(action.value) <= logged.balance + logged.balanceAction)
    {
        sellButton.disabled = false;
        buyButton.disabled = true;

        setData('add-action-to', {actionCode: action.code, playerId: logged.id})

        setData('update-logged-wallet', {
            balance: logged.balance - parseFloat(action.value),
            id: logged.id}
        );

        await balance_update();
    }
}
async function actions_init()
{
    const pid = 'action-panel';

    const actions = await getData('actions');

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


