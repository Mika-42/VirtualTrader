const switchAct = document.getElementById('action-btn');
const switchRank = document.getElementById('ranking-btn');
switchAct.addEventListener('click', () => {
    document.getElementById('action-panel').style.display = 'block';
    document.getElementById('ranking-panel').style.display = 'none';
});

async function switchRank_callback()
{
    document.getElementById('action-panel').style.display = 'none';
    document.getElementById('ranking-panel').style.display = 'flex';
    await ranking_update();
}
switchRank.addEventListener('click', switchRank_callback);