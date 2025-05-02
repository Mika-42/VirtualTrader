const switchAct = document.getElementById('action-btn');
const switchRank = document.getElementById('ranking-btn');
switchAct.addEventListener('click', () => {
    document.getElementById('action-panel').style.display = 'block';
    document.getElementById('ranking-panel').style.display = 'none';
});

switchRank.addEventListener('click', () => {
    document.getElementById('action-panel').style.display = 'none';
    document.getElementById('ranking-panel').style.display = 'flex';
});