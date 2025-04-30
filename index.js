const formatBalanceAccount = (balanceAccount) =>
{
    const formatedIntValue = new Intl.NumberFormat('fr-FR').format(parseInt(balanceAccount));
    const decimalValue = balanceAccount.toFixed(2).split('.')[1];
    return `${formatedIntValue}.${decimalValue}€`;
};

const ids = Array.from(document.querySelectorAll('.action')).map(i => i.id);

const dateEl = document.getElementById('date');
dateEl.innerText = startDate.toLocaleDateString();

const balanceAccount = document.getElementById('balance-account');
let balanceAccountValue = 10000.00; // todo get this value from php !
balanceAccount.innerText =  formatBalanceAccount(balanceAccountValue);

updateChart(startDate, balanceAccountValue );

    const daily = () => {
        startDate.setDate(startDate.getDate() + 1);
        dateEl.innerText = startDate.toLocaleDateString();

        updateChart(startDate, balanceAccountValue );

        for(let i = 0; i < 3; ++i)
        {
            updateActionsChart(graphAct[i], startDate,  Math.floor(Math.random() * (200 - 50 + 1)) + 50); //todo remove fake value
        }
        for(const id of ids)
        {
            //todo query price and previous evolution
            //updatePrice();
        }

    }


const timeout = 500;
setInterval(daily, timeout);

