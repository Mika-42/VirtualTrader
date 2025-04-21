const dateToString = (date) => {
    const options = {year: 'numeric', month: 'long'};
    return date.toLocaleDateString('fr-FR', options);
}

    const ids = ['apple-action', 'tesla-action', 'amazon-action', 'microsoft-action', 'alphabet-action', 'cocacola-action', 'nike-action', 'intel-action', 'boeing-action', 'visa-action',];
    let startDate = new Date(2025, 0);
    const dateEl = document.getElementById('date');

    dateEl.innerText = dateToString(startDate);

    //---function
    const formatBalanceAccount = (balanceAccount) =>
    {
        const formatedIntValue = new Intl.NumberFormat('fr-FR').format(parseInt(balanceAccount));
        const decimalValue = balanceAccount.toFixed(2).split('.')[1];
        return `${formatedIntValue}.${decimalValue}€`;
    };

    const updatePrice = (price, evolutionPreviousMoth) => {

            const variation = (Math.random() * 6) - 3; // [-3, 3]

            let evolution = evolutionPreviousMoth + variation;

            evolution = Math.max(-10, Math.min(10, evolution));

            let p = price * (1 + evolution / 100);

            p = Math.max(1, p);

            return {
                price: Math.round(p * 100) / 100,
                evolution: Math.round(evolution * 100) / 100
            };
    }

    const daily = () => {
        startDate.setMonth(startDate.getMonth() + 1);
        dateEl.innerText = dateToString(startDate);
        for(const id of ids)
        {
            //todo query price and previous evolution
            updatePrice();
        }
    }

    const balanceAccount = document.getElementById('balance-account');
    let balanceAccountValue = 10000.00; // todo get this value from php !

    for(const id of ids)
    {
        const btnSell = document.querySelector(`#${id} .action-sell`);
        const btnBuy = document.querySelector(`#${id} .action-buy`);

        /**
         * todo get this from php
         * query the good id then access to name in html
         * check if the name match with name in table
         */
        let price = document.querySelector(`#${id} .action-price`).innerHTML;

        btnSell.addEventListener('click', () => {
            btnSell.disabled = true;
            btnBuy.disabled = false;
            balanceAccountValue += parseFloat(price);
            balanceAccount.innerText =  formatBalanceAccount(balanceAccountValue);
        });

        btnBuy.addEventListener('click', () => {
            btnSell.disabled = false;
            btnBuy.disabled = true;
            balanceAccountValue -= parseFloat(price);
            balanceAccount.innerText =  formatBalanceAccount(balanceAccountValue);
        });
    }

setInterval(daily, 60000);