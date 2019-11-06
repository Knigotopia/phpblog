<?php
include("blocks/db.php");

?>

<html>
<head>
  <title>Редактировать страницу</title>
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
            <p>Выберите страницу для редактирования:</p>
<?php
if (!isset($_GET['id'])) {
    $stmt=$pdo->prepare("SELECT id,title FROM settings");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
      printf("<p class='lesson_name'>
      <a href='edit_text.php?id=%s'>%s</a></p>",
      $row["id"], $row["title"]);
    }
} else {
    $id = $_GET['id'];
    $stmt=$pdo->prepare("SELECT * FROM settings WHERE id=:id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();

  print <<<HERE
  <form name="form1" method="post" action="update_text.php">
    <p><label>Введите название страницы (тэг title)
      <br><input value="$row[title]" type="text" name="title" id="title" size="60" required>
      </label>
    </p>
    <p><label>Введите описание страницы
      <br><input value="$row[meta_d]" type="text" name="meta_d" id="meta_d" size="60" required>
      </label>
    </p>
    <p><label>Введите ключевые для страницы
      <br><input value="$row[meta_k]" type="text" name="meta_k" id="meta_k" size="60" required>
      </label>
    </p>
    <p><label>Введите полный текст страницы с тэгами
      <textarea type="text" name="text" id="text" cols="60"
      rows="20" required>$row[text]</textarea>
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
