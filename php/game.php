<?php
global $data;
include 'interface.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../index.css">
  <title>VirtualTrader</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-financial"></script>

</head>
<body>
<main>
  <header id="info">
    <div id="menu-container" class="user-data"><a id="menu-btn" href="menu.php">MENU</a></div>
    <h2 id="date" class="user-data"></h2>
    <h2 id="username" class="user-data"></h2>
    <h2 id="balance-account" class="user-data"></h2>
  </header>

  <div id="graph-widget">

    <div class="graph-container">
      <canvas id="graph" class="chart"></canvas>
    </div>

    <div id="group">
      <div class="chart-container">
        <div class="graph-container sub-graph">
          <canvas id="action-chart-1" class="chart action-graph"></canvas>
        </div>


      </div>


      <div class="chart-container">
        <div class="graph-container sub-graph">
          <canvas id="action-chart-2" class="chart action-graph"></canvas>
        </div>
      </div>

      <div class="chart-container">
        <div class="graph-container sub-graph">
          <canvas id="action-chart-3" class="chart action-graph"></canvas>
        </div>
      </div>

    </div>
  </div>
</main>

<aside id="side-panel">
    <div id="action-panel">
        <div class="filter">
        <span class="filterText">Filter:</span>
        <input type="radio" id="filter-all-btn" name="filter" class="toggle-input" checked>
        <label for="filter-all-btn" class="toggle-label">All</label>

        <input type="radio" id="filter-buy-btn" name="filter" class="toggle-input">
        <label for="filter-buy-btn" class="toggle-label">Buy</label>

        <input type="radio" id="filter-sold-btn" name="filter" class="toggle-input">
        <label for="filter-sold-btn" class="toggle-label">Sold</label>
    </div>

        <div class="filter">
        <span class="filterText">Sort:</span>

        <input type="radio" id="filter-name-btn" name="sub-filter" class="toggle-input" checked>
        <label for="filter-name-btn" class="toggle-label">Name</label>

        <input type="radio" id="filter-price-btn" name="sub-filter" class="toggle-input">
        <label for="filter-price-btn" class="toggle-label">Price</label>

        <input type="radio" id="filter-progression-btn" name="sub-filter" class="toggle-input">
        <label for="filter-progression-btn" class="toggle-label">Progression</label>
    </div>
    </div>
    <div id="ranking-panel" style="display: none;">
    </div>
    <div id="switch">
        <input type="radio" id="action-btn" name="switch" class="toggle-input" checked>
        <label id="act-lbl" for="action-btn" class="switch-label">Action</label>

        <input type="radio" id="ranking-btn" name="switch" class="toggle-input">
        <label id="ranking-lbl" for="ranking-btn" class="switch-label">Ranking</label>
    </div>
</aside>

</body>

<script src="user_data.js"></script>
<script src="actions.js"></script>
<script src="filter.js"></script>

<script>
    fetch('fetch.php?action=init')
        .then(response => response.json())
        .then(data => {
            init_actions(data);
            update_player_data(data);
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
</script>

<!--<script src="fetch.js"></script>-->
<!--<script src="view-switch.js"></script>-->
<!--<script src="balance-account.js"></script>-->
<!--<script src="chart-selector.js"></script>-->
<!--<script src="ranking.js"></script>-->
<!--<script src="action.js"></script>-->
<!--<script src="action-graph.js"></script>-->
<!--<script src="graph.js"></script>-->
<!--<script src="index.js"></script>-->
<!--<script src="filter.js"></script>-->

</html>