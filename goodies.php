<?php

include("blocks/db.php");
$sql = "SELECT COUNT(*) FROM settings WHERE id=3";
if ($stmt = $pdo->query($sql)) {

  if ($stmt->fetchColumn() > 0) {
    $stmt = $pdo->query('SELECT * FROM settings WHERE id=3');
  }
    $row = $stmt->fetch();
} else {
    echo "Нет строк для вывода";
}
if (!$row) {
  echo "<p>Запрос на выборку данных из базы не может быть выполнен.
  Сообщите об этом администратору sorok@ukr.net <br>
  <strong>Код ошибки:</strong> </p>";
    echo "\nPDO::errorInfo():\n";
    print_r($pdo->errorInfo());
    exit($row);
}
?>


<html>
<head>
  <meta name="description" content="<?= $row['meta_d']; ?>">
  <meta name="keywords" content="<?= $row['meta_k']; ?>">
  <meta charset="utf-8" content="text/html" http-equiv="content-type">
  <title><?= $row['title']; ?></title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <table width="690" border="0" align="center" cellpadding="0"
  cellspacing="0" bgcolor="#FFFFFF" class="main_border">
    <tr>
      <td>
        <?php include("blocks/header.php"); ?>
      </td>
    </tr>
    <tr>
      <td>
        <table width="690" border="0" cellpadding="0"
        cellspacing="0">
          <tr>
          <!-- Левый блок сайта-->
            <?php include("blocks/lefttd.php"); ?>

            <td valign="top">
              <!-- Навигация сайта-->
              <?php $n=3; include("blocks/nav.php"); ?>
              <?= $row['text']; ?>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <?php include("blocks/footer.php"); ?>
      </td>
    </tr>
  </table>
</body>
</html>
