
const dateEl = document.getElementById('date');

function getLastDayOfMonth(year, month) {
        // Create a date object for the first day of the next month
        const date = new Date(year, month + 1, 0); // 0 means the last day of the previous month
        return date.getDate(); // Get the last day of the current month
}

async function daily()
{
        const logged = await getData('logged-user');
        const gameDate = new Date(logged.gameDate);

        gameDate.setDate(gameDate.getDate() + 1);
        dateEl.innerText = gameDate.toLocaleDateString();

        if(gameDate.getDate() === getLastDayOfMonth(gameDate.getFullYear(), gameDate.getMonth()))
        {
                await balance_update();
                await updateChart();
                await ui_action_update();
                await update_actions_chart();
                await ranking_update();

                if(filterPriceBtn.checked)
                {
                        await sortByPrice();
                }

                if(filterEvolutionBtn.checked)
                {
                        await sortByEvolution();
                }
        }
}

async function init() {


        let logged = await getData('logged-user');
        dateEl.innerText = new Date(logged.gameDate).toLocaleDateString();

        balance_update()
        .then(updateChart)
        .then(chart_selector_init)
        .then(actions_init);
        //! await updateChart();
        //! await chart_selector_init();
        //! await actions_init();
        // await sortByName();
        // await ranking_init();
}
//document.addEventListener('DOMContentLoaded', init);

init().then(() => {
        const timeout = 100 //500;
       // setInterval(daily, timeout);
});


