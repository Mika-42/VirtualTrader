

const ids = Array.from(document.querySelectorAll('.action')).map(i => i.id);

const dateEl = document.getElementById('date');
dateEl.innerText = startDate.toLocaleDateString();

function getLastDayOfMonth(year, month) {
        // Create a date object for the first day of the next month
        const date = new Date(year, month + 1, 0); // 0 means the last day of the previous month
        return date.getDate(); // Get the last day of the current month
}

updateChart(startDate, balanceAccountValue );

const daily = () => {
        startDate.setDate(startDate.getDate() + 1);
        dateEl.innerText = startDate.toLocaleDateString();



        if(startDate.getDate() === getLastDayOfMonth(startDate.getFullYear(), startDate.getMonth()))
        {
                updateChart(startDate, balanceAccountValue );
                action_update();
                balance_update();

                for(let i = 0; i < 3; ++i)
                {
                        let codes = get_chart_selector_id();
                        const act = Array.from(SESSION_DATA['actions']).find(e => e.code === codes[i]);
                        updateActionsChart(i, startDate,  act);
                }
        }

    }

document.addEventListener('DOMContentLoaded', () => {
        chart_selector_init();
        actions_init();
        show_username();
})
balance_update();




const timeout = 100 //500;
setInterval(daily, timeout);

