const rankingView = document.getElementById('ranking-panel');

function ranking_update(players)
{
    const p = document.getElementById('ranking-panel');
    const top10 = p.querySelectorAll('.rank');

    top10.forEach((e, i) => {
        e.querySelector('.index').innerText = i + 1;
        e.querySelector('.username').innerText = players[i].username;
        e.querySelector('.balance').innerText = format_wallet(players[i].totalWallet);
    })
}

function ranking_init(players)
{
    players.forEach((i) => {
        const rank = {
            act: document.createElement('div'),
            index: document.createElement('span'),
            username: document.createElement('span'),
            balance: document.createElement('span')
        };

        rank.act.className = 'rank';
        rank.index.className = 'index';

        rank.username.className = 'username';
        rank.username.innerText = i.username;

        rank.balance.className = 'balance';
        rank.balance.innerText = format_wallet(i.totalWallet);

        rank.act.appendChild(rank.index);
        rank.act.appendChild(rank.username);
        rank.act.appendChild(rank.balance);
        rankingView.appendChild(rank.act);
    })
}

const switchAct = document.getElementById('action-btn');
const switchRank = document.getElementById('ranking-btn');
switchAct.addEventListener('click', () => {
    document.getElementById('action-panel').style.display = 'block';
    document.getElementById('ranking-panel').style.display = 'none';
});

function switchRank_callback()
{
    document.getElementById('action-panel').style.display = 'none';
    document.getElementById('ranking-panel').style.display = 'flex';
}
switchRank.addEventListener('click', switchRank_callback);