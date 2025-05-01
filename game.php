<?php
include('db_connexion.php');
include('fetch_data.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="index.css">
  <title>Title</title>
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

        <span>
                <label for="actionSelect-1">Action: </label>
          <!--                todo add actions in js-->
                <select id="actionSelect-1">
                    <option value="apple">Apple</option>
                    <option value="banana">Banana</option>
                    <option value="cherry">Cherry</option>
                    <option value="date">Date</option>
                    <option value="elderberry">Elderberry</option>
                </select>
                    </span>
      </div>


      <div class="chart-container">
        <div class="graph-container sub-graph">
          <canvas id="action-chart-2" class="chart action-graph"></canvas>
        </div>

        <span>
                <label for="actionSelect-2">Action: </label>
          <!--                todo add actions in js-->
                <select id="actionSelect-2">
                    <option value="apple">Apple</option>
                    <option value="banana">Banana</option>
                    <option value="cherry">Cherry</option>
                    <option value="date">Date</option>
                    <option value="elderberry">Elderberry</option>
                </select>
                    </span>
      </div>


      <div class="chart-container">
        <div class="graph-container sub-graph">
          <canvas id="action-chart-3" class="chart action-graph"></canvas>
        </div>

        <span>
                <label for="actionSelect-3">Action: </label>
          <!--                todo add actions in js-->
                <select id="actionSelect-3">
                    <option value="apple">Apple</option>
                    <option value="banana">Banana</option>
                    <option value="cherry">Cherry</option>
                    <option value="date">Date</option>
                    <option value="elderberry">Elderberry</option>
                </select>
                    </span>
      </div>

    </div>
  </div>
</main>
<aside id="action-panel">
  <div id="filter">
    <span id="filterText">Filter:</span>
    <input type="radio" id="filter-all-btn" name="filter" class="toggle-input" checked>
    <label for="filter-all-btn" class="toggle-label">All</label>

    <input type="radio" id="filter-buy-btn" name="filter" class="toggle-input">
    <label for="filter-buy-btn" class="toggle-label">Buy</label>

    <input type="radio" id="filter-sold-btn" name="filter" class="toggle-input">
    <label for="filter-sold-btn" class="toggle-label">Sold</label>
  </div>
</aside>
</body>

<script>
  let startDate = new Date('01/01/2025');
  let SESSION_DATA = <?php echo json_encode($data); ?>;
</script>

<!--<script src="fetch-data.js"></script>-->
<script src="balance-account.js"></script>
<script src="action.js"></script>
<script src="action-graph.js"></script>
<script src="graph.js"></script>
<script src="index.js"></script>
<script src="filter.js"></script>

</html>