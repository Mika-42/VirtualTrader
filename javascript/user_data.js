function format_wallet(num)
{
    const roundedNum = parseFloat(num).toFixed(2);

    const [integerPart, decimalPart] = roundedNum.split('.');

    const formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

    return `${formattedInteger}.${decimalPart}€`;
}

function update_wallet(data)
{
    const wallet = document.getElementById('balance-account');
    wallet.innerText = format_wallet(data.wallet);
}

function update_player_data(data)
{
    const html = {
        username_field: document.getElementById('username'),
        date_field: document.getElementById('date'),
        wallet_field: document.getElementById('balance-account')
    };

    //set name
    html.username_field.innerText = data.username;

    //set date
    html.date_field.innerText = new Date(data.date).toLocaleDateString('FR-fr');

    //set wallet
    update_wallet(data);

}