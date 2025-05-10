
fetch('fetch.php?action=init')
    .then(response => response.json())
    .then(data => {
        init_actions(data);
        update_player_data(data);
        ranking_init(data.players);
        chart_selector_init(data);
        updateChart(data);
        console.log(data); //todo remove
    })
    .catch(err => console.error("Fetch error:", err))

setInterval(() => {
    fetch('fetch.php?action=daily_update')
        .then(response => response.json())
        .then(data => {

            if(data.wallet < 1000) {
                window.location.href = "game-over.php";
            }

            update_actions(data.actions);
            update_player_data(data);
            ranking_update(data.players);
            update_actions_chart(data);
            updateChart(data);

            if(filterPriceBtn.checked)
            {
                generic_sort('value');
            }

            if(filterEvolutionBtn.checked)
            {
                generic_sort('evolution');
            }
        })
        .catch(err => console.error("Fetch error:", err))
}, 500);