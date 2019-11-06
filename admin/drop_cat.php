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

  /*Удаляем данные из базы*/

  $stmt = $pdo->prepare("SELECT id FROM data WHERE cat=:id");
  $stmt->execute(['id' => $id]);

  $count = $stmt->rowCount();

  if ($count > 0) {
    echo "<p>В категории, которую Вы хотите удалить, есть заметки. Сначала
    перекиньте их в другие категории</p>";
  } else {
    $sql = "DELETE FROM categories WHERE id=:id";

    $result = $pdo->prepare($sql)->execute(['id' => $id]);

      if ($result) {
        echo "<p>Данные успешно удалены!</p>";
      } else {
        echo "<p>Ошбика! Данные не удалось удалить</p>";
      }
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
