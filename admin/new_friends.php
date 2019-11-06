<?php
include("blocks/db.php");
?>

<html>
<head>
  <title>Добавить сайты друзей</title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="690" border="0" align="center" cellpadding="0"
cellspacing="0" bgcolor="#FFFFFF" class="main_border">

<!-- Шапка сайта -->
<?php include("blocks/header.php"); ?>

  <tr>
    <td>
        <table width="690" border="0" cellpadding="0"
        cellspacing="0">
        <tr>
          <!-- Левый блок сайта-->
          <?php include("blocks/lefttd.php"); ?>
          <!-- Основной блок сайта-->
          <td valign="top">
            <form name="form1" method="post" action="add_friends.php">
              <p><label>Введите название сайта друзей
                <br><input type="text" name="title" id="title" size="60" required>
                </label>
              </p>
              <p><label>Введите ссылку на сайт друзей
                <br><input type="text" name="link" id="link" size="60" required>
                </label>
              </p>
              <p><label>
                <input type="submit" value="Добавить" id="submit">
              </label>
              </p>
            </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <!-- Нижний блок -->
<?php include("blocks/footer.php"); ?>
</table>
</body>
</html>
