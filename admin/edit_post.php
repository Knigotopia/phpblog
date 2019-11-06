<?php
include("blocks/db.php");
?>

<html>
<head>
  <title>Страница редактирования заметки</title>
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
            <p>Выберите заметку для редактирования:</p>
<?php

if (!isset($_GET['id'])) {
    $stmt=$pdo->prepare("SELECT id,title FROM data");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
      printf("<p class='lesson_name'>
      <a href='edit_post.php?id=%s'>%s</a></p>",
      $row["id"], $row["title"]);
    }
} else {
    $id = $_GET['id'];
    $stmt=$pdo->prepare("SELECT * FROM data WHERE id=:id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();

    $stmt2=$pdo->prepare("SELECT * FROM categories");
    $stmt2->execute();

  echo "<form name='form1' method='post' action='update_post.php'>
      <p><label>Введите категорию
      <br><select name='cat'>";
  while ($row2 = $stmt2->fetch()) {

    if ($row["cat"] == $row2["id"]) {
      printf("<option value='%s' selected>%s</option>", $row2["id"], $row2["title"]);
    } else {
      printf("<option value='%s'>%s</option>", $row2["id"], $row2["title"]);
    }
  }

  echo "</select>
      </label>
    </p>";

  print <<<HERE

    <p><label>Введите название заметки
      <br><input value="$row[title]" type="text" name="title" id="title" size="60" required>
      </label>
    </p>
    <p><label>Введите описание заметки
      <br><input value="$row[meta_d]" type="text" name="meta_d" id="meta_d" size="60" required>
      </label>
    </p>
    <p><label>Введите ключевые слова
      <br><input value="$row[meta_k]" type="text" name="meta_k" id="meta_k" size="60" required>
      </label>
    </p>
    <p><label>Введите дату добавления заметки
      <br><input value="$row[date]" type="text" name="date" id="date"
      value="">
    </label>
    </p>
    <p><label>Введите краткое описание заметки с тэгами
      <textarea type="text" name="description" id="description"
      cols="60" rows="5" required>$row[description]</textarea>
      </label>
    </p>
    <p><label>Введите содержание заметки с тэгами
      <textarea type="text" name="text" id="text" cols="60"
      rows="20" required>$row[text]</textarea>
      </label>
    </p>
    <p><label>Введите автора заметки
      <br><input value="$row[author]" type="text" name="author" id="author" size="50" required>
      </label>
    </p>
    <p><label>Введите место хранения миниатюры
      <br><input value="$row[mini_img]" type="text" name="img" id="img" size="50" required>
      </label>
    </p>

    <p>
      <input name="id" type="hidden" value="$row[id]">
    </p>
    <p><label>
      <input type="submit" value="Сохранить изменения" id="submit">
    </label>
    </p>
  </form>
HERE;
}

?>
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
