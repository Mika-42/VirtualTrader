const formatBalanceAccount = (num) => {
    const roundedNum = parseFloat(num).toFixed(2);

    const [integerPart, decimalPart] = roundedNum.split('.');

    const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

    return `${formattedInteger}.${decimalPart}€`;
}
async function balance_update()
{
    const logged = await getData('logged-user');

    const e = document.getElementById('balance-account');
    const totalWallet = await getData('logged-total-wallet');
    e.innerText =  formatBalanceAccount(totalWallet.totalWallet);
}

