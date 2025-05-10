<?php
include 'interface.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/index.css">
  <title>VirtualTrader</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-financial"></script>

</head>
<body>
<main>
  <header id="info">
    <div id="menu-container" class="user-data"><a id="menu-btn" href="menu.php?id=<?php echo $_SESSION['id']; ?>">MENU</a></div>
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

<script src="../javascript/user_data.js"></script>
<script src="../javascript/actions.js"></script>
<script src="../javascript/filter.js"></script>
<script src="../javascript/ranking.js"></script>
<script src="../javascript/chart-selector.js"></script>
<script src="../javascript/action-graph.js"></script>
<script src="../javascript/graph.js"></script>
<script src="../javascript/index.js"></script>
</html>