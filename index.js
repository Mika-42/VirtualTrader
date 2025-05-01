

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
                        updateActionsChart(graphAct[i], startDate,  Math.floor(Math.random() * (200 - 50 + 1)) + 50); //todo remove fake value
                }
        }

    }

balance_update();
show_username();
actions_init();

const timeout = 500;
setInterval(daily, timeout);

