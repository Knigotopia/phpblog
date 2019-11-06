<?php
include("blocks/db.php");
?>

<html>
<head>
  <title>Добавить категорию</title>
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
            <form name="form1" method="post" action="add_cat.php">
              <p><label>Введите название категории
                <br><input type="text" name="title" id="title" size="60" required>
                </label>
              </p>
              <p><label>Введите описание категории
                <br><input type="text" name="meta_d" id="meta_d" size="60" required>
                </label>
              </p>
              <p><label>Введите ключевые слова
                <br><input type="text" name="meta_k" id="meta_k" size="60" required>
                </label>
              </p>
              <p><label>Введите содержание категории с тэгами
                <textarea type="text" name="text" id="text" cols="60"
                rows="20" required></textarea>
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
