const balanceAccount = document.getElementById('balance-account');
let balanceAccountValue = 10000;

const formatBalanceAccount = (num) => {
    const roundedNum = parseFloat(num).toFixed(2);

    const [integerPart, decimalPart] = roundedNum.split('.');

    const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

    return `${formattedInteger}.${decimalPart}€`;
}

const updateBalance = (data) => {
    balanceAccountValue = data['logged'].balance;
    balanceAccount.innerText =  formatBalanceAccount(balanceAccountValue);
}

getFromPHP(updateBalance);
getFromPHP((data) => {
    const e = document.getElementById('username');
    e.innerText = data['logged'].username;
});
