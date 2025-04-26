const actions = document.querySelectorAll('.action');

//---
const filterAllBtn = document.getElementById('filter-all-btn');
filterAllBtn.addEventListener('click', () => {
    actions.forEach((i) => i.style.display = "flex");
});

//---
const filterBuyBtn = document.getElementById('filter-buy-btn');
filterBuyBtn.addEventListener('click', () => {
    actions.forEach((i) => {
        const isOwnBySomeone = i.querySelector('button[title="buy"]').disabled

        i.style.display = isOwnBySomeone ? "flex" : "none";
    });
});

//---
const filterSoldBtn = document.getElementById('filter-sold-btn');
filterSoldBtn.addEventListener('click', () => {
    actions.forEach((i) => {
        const isOwnBySomeone = i.querySelector('button[title="sell"]').disabled

        i.style.display = isOwnBySomeone ? "flex" : "none";
    });
});