const rankingView = document.getElementById('ranking-panel');

const ranking_init = () => {
    let playerList = Array.from(SESSION_DATA['players']).sort((a, b) => (b.balance + b.balanceAction) - (a.balance - a.balanceAction));

    playerList.forEach(() => {
        const act = document.createElement('div');

    })
}
const ranking_update = () => {

}

ranking_init()