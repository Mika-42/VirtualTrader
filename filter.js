const actionsData = Array.from(SESSION_DATA['actions']);

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
filterNameBtn.addEventListener('click', () => {
    const parent = document.getElementById('action-panel');
    const orderByName = actionsData.sort((a, b) => a.name.localeCompare(b.name)).map(e => e.code)

    orderByName.forEach((id) => {
        const _ = document.getElementById(id);
        parent.appendChild(_);
    });
});

///---
const filterPriceBtn = document.getElementById('filter-price-btn');
filterPriceBtn.addEventListener('click', () => {
    const parent = document.getElementById('action-panel');
    const orderByName = actionsData.sort((a, b) => b.price - a.price).map(e => e.code)

    orderByName.forEach((id) => {
        const _ = document.getElementById(id);
        parent.appendChild(_);
    });
});