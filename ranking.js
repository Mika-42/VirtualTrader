const rankingView = document.getElementById('ranking-panel');

async function ranking_update()
{
    const p = document.getElementById('ranking-panel');
    const top10 = p.querySelectorAll('.rank');

    const values = await getData('all-player-total-wallet');

    top10.forEach((e, i) => {
        e.querySelector('.index').innerText = i + 1;
        e.querySelector('.username').innerText = values[i].username;
        e.querySelector('.balance').innerText = formatBalanceAccount(values[i].balance);
    });
}

async function ranking_init()
{
    let playerList = await getData('all-player-sorted-by-total-wallet');
    console.log(playerList)

    playerList.forEach((i) => {
        const act = document.createElement('div');
        const index = document.createElement('span');
        const username = document.createElement('span');
        const balance = document.createElement('span');
        act.className = 'rank';
        index.className = 'index';

        username.className = 'username';
        username.innerText = i.username;

        balance.className = 'balance';
        balance.innerText = formatBalanceAccount(i.totalWallet);

        act.appendChild(index);
        act.appendChild(username);
        act.appendChild(balance);
        rankingView.appendChild(act);
    })
}