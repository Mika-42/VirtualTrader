const rankingView = document.getElementById('ranking-panel');

const ranking_update = () => {
    const p = document.getElementById('ranking-panel');
    const top10 = p.querySelectorAll('.rank');

    let player = Array
        .from(SESSION_DATA['players'])
        .filter(e => e.id !== SESSION_DATA['logged'].id);

    player.push(SESSION_DATA['logged']);

    const values = player.sort((a, b) => {
        return (b.balance + b.balanceAction) - (a.balance + a.balanceAction);
    });

    top10.forEach((e, i) => {
        e.querySelector('.index').innerText = i + 1;
        e.querySelector('.username').innerText = values[i].username;

        console.log(parseFloat(values[i].balance), SESSION_DATA['logged'].balance);
        e.querySelector('.balance').innerText = formatBalanceAccount(
            parseFloat(values[i].balance) + parseFloat(values[i].balanceAction)
        );
        p.appendChild(e);
    });
}

const ranking_init = () => {
    let playerList = Array.from(SESSION_DATA['players']).sort((a, b) => {
        return (parseFloat(b.balance) + parseFloat(b.balanceAction)) - (parseFloat(a.balance) - parseFloat(a.balanceAction))
    }).slice(0, 10);
    const p = document.getElementById('ranking-panel');
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
        balance.innerText = formatBalanceAccount(parseFloat(i.balance) + parseFloat(i.balanceAction));

        act.appendChild(index);
        act.appendChild(username);
        act.appendChild(balance);
        p.appendChild(act);
    })
    //ranking_update();
}