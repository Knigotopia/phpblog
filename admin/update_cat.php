<?php
include("blocks/db.php");

?>

<html>
<head>
  <title>Обработчик</title>
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

$id = $_POST['id'];
$title = $_POST['title'];
$meta_d = $_POST['meta_d'];
$meta_k = $_POST['meta_k'];
$text = $_POST['text'];

  /*Здесю заносим данные в базу*/
  $sql = "UPDATE categories SET title=:title, meta_d=:meta_d, meta_k=:meta_k,
  text=:text WHERE id=:id";

  $result = $pdo->prepare($sql)->execute(['title' => $title, 'meta_d' => $meta_d,
  'meta_k' => $meta_k, 'text' => $text, 'id' => $id]);

    if ($result) {
      echo "<p>Данные успешно обновлены!</p>";
    } else {
      echo "<p>Ошбика! Данные не обновлены</p>";
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
