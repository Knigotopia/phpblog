<?php
include("blocks/db.php");
?>

<html>
<head>
  <title>Обработчик урока</title>
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
<?php

$title = $_POST['title'];
$meta_d = $_POST['meta_d'];
$meta_k = $_POST['meta_k'];
$date = $_POST['date'];
$description = $_POST['description'];
$text = $_POST['text'];
$author = $_POST['author'];
$img = $_POST['img'];
$cat = $_POST['cat'];


  /*Здесю заносим данные в базу*/
  $sql = "INSERT INTO data (title, meta_d, meta_k, date, description,
  text, author, mini_img, cat) VALUES (?,?,?,?,?,?,?,?,?)";

  $result = $pdo->prepare($sql)->execute([$title, $meta_d, $meta_k, $date,
  $description, $text, $author, $img, $cat]);

    if ($result) {
      echo "<p>Данные занесены в таблицу!</p>";
    } else {
      echo "<p>Ошбика! Заметка не добавлена в таблицу.</p>";
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
