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
function generic_sort(type)
{
    fetch(`fetch.php?action=filter_by_${type}`)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            data.forEach((el) => {
                const _ = document.getElementById(el.code);
                const panel = document.getElementById('action-panel');
                panel.appendChild(_);
            });
        }).catch(err => console.error(err));
}

const filterNameBtn = document.getElementById('filter-name-btn');
filterNameBtn.addEventListener('click', () => generic_sort('name'));

///---
const filterPriceBtn = document.getElementById('filter-price-btn');
filterPriceBtn.addEventListener('click', () => generic_sort('value'));
///---
const filterEvolutionBtn = document.getElementById('filter-progression-btn');

filterEvolutionBtn.addEventListener('click', () => generic_sort('evolution'));