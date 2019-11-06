<?php
include("blocks/db.php");
?>

<html>
<head>
  <title>Добавить заметку</title>
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
            <form name="form1" method="post" action="add_post.php">
              <p><label>Введите название заметки
                <br><input type="text" name="title" id="title" size="60" required>
                </label>
              </p>
              <p><label>Введите описание заметки
                <br><input type="text" name="meta_d" id="meta_d" size="60" required>
                </label>
              </p>
              <p><label>Введите ключевые слова
                <br><input type="text" name="meta_k" id="meta_k" size="60" required>
                </label>
              </p>
              <p><label>Введите дату добавления
                <br><input type="date" name="date" id="date"
                value="">
              </label>
              </p>
              <p><label>Введите краткое описание заметки с тэгами
                <textarea type="text" name="description" id="description"
                cols="60" rows="5" required></textarea>
                </label>
              </p>
              <p><label>Введите содержание заметки с тэгами
                <textarea type="text" name="text" id="text" cols="60"
                rows="20" required></textarea>
                </label>
              </p>
              <p><label>Введите автора заметки
                <br><input type="text" name="author" id="author" size="50" required>
                </label>
              </p>
              <p><label>Введите место хранения миниатюры
                <br><input type="text" name="img" id="img" size="50" required>
                </label>
              </p>
              <p><label>Введите категорию
                <br><select name="cat">
                  <?php
                    $stmt = $pdo->prepare("SELECT title,id FROM categories");
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                      printf("<option value='%s'>%s</option>", $row['id'],
                      $row['title']);
                    }
                  ?>
                </select>
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
