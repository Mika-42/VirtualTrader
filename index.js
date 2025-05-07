
const dateEl = document.getElementById('date');
dateEl.innerText = SESSION_DATA['logged'].gameDate.toLocaleDateString();

function getLastDayOfMonth(year, month) {
        // Create a date object for the first day of the next month
        const date = new Date(year, month + 1, 0); // 0 means the last day of the previous month
        return date.getDate(); // Get the last day of the current month
}

const daily = () => {
        SESSION_DATA['logged'].gameDate.setDate(SESSION_DATA['logged'].gameDate.getDate() + 1);
        dateEl.innerText = SESSION_DATA['logged'].gameDate.toLocaleDateString();

        if(SESSION_DATA['logged'].gameDate.getDate() === getLastDayOfMonth(SESSION_DATA['logged'].gameDate.getFullYear(), SESSION_DATA['logged'].gameDate.getMonth()))
        {
                balance_update();
                updateChart();
                action_update();
                update_actions_chart();
                ranking_update();

                if(filterPriceBtn.checked)
                {
                        sortByPrice();
                }

                if(filterEvolutionBtn.checked)
                {
                        sortByEvolution();
                }
        }

    }

document.addEventListener('DOMContentLoaded', () => {
        balance_update();
        updateChart();
        chart_selector_init();
        actions_init();
        show_username();
        sortByName();
        ranking_init();
})


const timeout = 100 //500;
setInterval(daily, timeout);

