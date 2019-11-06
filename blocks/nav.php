<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%"
      <?php if (isset($n)) {
          if ($n == 1) {
            echo "class='nav_active'";
          } else {
            echo "class='nav'";
          }
        }
      ?>
      ><p><a href="index.php">Главная</a></p></td>
    <td width="25%"
      <?php if (isset($n)) {
          if ($n == 2) {
            echo "class='nav_active'";
          } else {
            echo "class='nav'";
          }
        }
      ?>
     ><p><a href="subscribe.php">Рассылка</a></p></td>
    <td width="25%"
      <?php if (isset($n)) {
          if ($n == 3) {
            echo "class='nav_active'";
          } else {
            echo "class='nav'";
          }
        }
      ?>
     ><p><a href="goodies.php">Товары</a></p></td>
    <td width="25%"
      <?php if (isset($n)) {
          if ($n == 4) {
            echo "class='nav_active'";
          } else {
            echo "class='nav'";
          }
        }
      ?>
      ><p><a href="about.php">О нас</a></p></td>
  </tr>
</table>
