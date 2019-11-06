<?php
include("blocks/db.php");
?>

<html>
<head>
  <title>Удаление категории</title>
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
            <p>Выберите категорию для удаления:</p>
              <form method="post" name="form1" action="drop_cat.php">
<?php

    $stmt=$pdo->prepare("SELECT id,title FROM categories");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
      printf("<p><input name='id' type='radio' value='%s'>
        <label>%s</label></p>",$row["id"], $row["title"]
      );
    }
?>
                <p><label>
                  <input name="submit" value="Удалить" type="submit">
                </label></p>
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
