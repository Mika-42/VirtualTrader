
let balanceAccountValue = SESSION_DATA['logged'].balance;

const formatBalanceAccount = (num) => {
    const roundedNum = parseFloat(num).toFixed(2);

    const [integerPart, decimalPart] = roundedNum.split('.');

    const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

    return `${formattedInteger}.${decimalPart}€`;
}

const balance_update = () => {
    const e = document.getElementById('balance-account');
    e.innerText =  formatBalanceAccount(balanceAccountValue);
}

const show_username = () => {
    const e = document.getElementById('username');
    e.innerText = SESSION_DATA['logged'].username;
}
