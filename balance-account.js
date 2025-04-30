const formatBalanceAccount = (num) => {
    // Use toFixed to round the number to two decimal places and convert to string
    const roundedNum = num.toFixed(2);

    // Convert to string and split into integer and decimal parts
    const [integerPart, decimalPart] = roundedNum.split('.');

    // Format the integer part with spaces as thousands separator
    const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

    // Combine the formatted integer and decimal parts
    return `${formattedInteger}.${decimalPart}€`;
}
const balanceAccount = document.getElementById('balance-account');
let balanceAccountValue = 0;
getFromPHP((data) => balanceAccountValue = data['balanceAccount'])
balanceAccount.innerText =  formatBalanceAccount(balanceAccountValue);