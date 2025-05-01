
let balanceAccountValue = SESSION_DATA['logged'].balance;
let userActionsCodes = [];
let totalAct = 0;
let TOTAL_WALLET = 0;

const formatBalanceAccount = (num) => {
    const roundedNum = parseFloat(num).toFixed(2);

    const [integerPart, decimalPart] = roundedNum.split('.');

    const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

    return `${formattedInteger}.${decimalPart}€`;
}

const balance_update = () => {

    const t = userActionsCodes.map(e => Array.from(SESSION_DATA['actions']).find(j => j.code === e).value)

    totalAct = 0;
    t.forEach(e => totalAct += e);
    const e = document.getElementById('balance-account');
    TOTAL_WALLET = parseFloat(balanceAccountValue) + totalAct;
    e.innerText =  formatBalanceAccount(TOTAL_WALLET);
}

const show_username = () => {
    const e = document.getElementById('username');
    e.innerText = SESSION_DATA['logged'].username;
}
