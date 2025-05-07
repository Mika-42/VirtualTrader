//---
const filterAllBtn = document.getElementById('filter-all-btn');
filterAllBtn.addEventListener('click', () => {
    const actions = document.querySelectorAll('.action');
    actions.forEach((i) => i.style.display = "flex");
});

//---
const filterBuyBtn = document.getElementById('filter-buy-btn');
filterBuyBtn.addEventListener('click', () => {
    const actions = document.querySelectorAll('.action');
    actions.forEach((i) => {
        const isOwnBySomeone = i.querySelector('button[title="buy"]').disabled

        i.style.display = isOwnBySomeone ? "flex" : "none";
    });
});

//---
const filterSoldBtn = document.getElementById('filter-sold-btn');
filterSoldBtn.addEventListener('click', () => {
    const actions = document.querySelectorAll('.action');
    actions.forEach((i) => {
        const isOwnBySomeone = i.querySelector('button[title="sell"]').disabled

        i.style.display = isOwnBySomeone ? "flex" : "none";
    });
});
///---
const filterNameBtn = document.getElementById('filter-name-btn');

async function sortByName()
{
    const parent = document.getElementById('action-panel');
    const orderByName = await getData('all-actions-by-name');
    orderByName.forEach((id) => {
        const _ = document.getElementById(id);
        parent.appendChild(_);
    });
}

filterNameBtn.addEventListener('click', sortByName);

///---
const filterPriceBtn = document.getElementById('filter-price-btn');

async function sortByPrice()
{
    const parent = document.getElementById('action-panel');
    const orderByPrice = await getData('all-actions-by-price');
    orderByPrice.forEach((id) => {
        const _ = document.getElementById(id);
        parent.appendChild(_);
    });
}

filterPriceBtn.addEventListener('click', sortByPrice);
///---
const filterEvolutionBtn = document.getElementById('filter-progression-btn');

async function sortByEvolution() {
    const parent = document.getElementById('action-panel');
    const orderByEvolution = await getData('all-actions-by-evolution');

    orderByEvolution.forEach((id) => {
        const _ = document.getElementById(id);
        parent.appendChild(_);
    });
}

filterEvolutionBtn.addEventListener('click', sortByEvolution);