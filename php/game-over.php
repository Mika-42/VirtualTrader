<?php
include 'interface.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/loginPage.css">
  <title>Menu</title>
</head>
<body>

<aside id="game-over-view">
  <h1 id="game-over-msg">Game over <?php echo htmlspecialchars(get_logged_username())?>...</h1>
    <div class="menu-btn" style="margin: 0">
    <a id="go-to-menu"  href="menu.php?id=<?php echo $_GET['id']; ?>">MENU</a>
    </div>
</aside>
</body>
</html>