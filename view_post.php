<?php

include("blocks/db.php");

$id = $_GET['id'];
if (!isset($id)) {
  $id = 1;
}

/* Проверяем, является ли переменная числом */
if (!preg_match("|^[\d]+$|", $id)) {
exit("<p>Неверный формат запроса! Проверьте URL!");
}

$sql = "SELECT COUNT(*) FROM data";
$stmt = $pdo->prepare($sql);
if ($stmt->execute()) {

  if ($stmt->fetchColumn() > 0) {
    $stmt = $pdo->prepare('SELECT * FROM data WHERE id=:id');
    $stmt->execute(['id' => $id]);
  }
    $row = $stmt->fetch();
    //Меняем кол-во просмотров:
    $new_view = $row['view'] + 1;
    $update = $pdo->prepare('UPDATE data SET view=:new_view WHERE id=:id');
    $update->execute(['id' => $id, 'new_view' => $new_view]);


} else {
    echo "Нет строк для вывода";
}
if (!$row) {
  echo "<p>Запрос на выборку данных из базы не может быть выполнен.
  Сообщите об этом администратору sorok@ukr.net <br>
  <strong>Код ошибки:</strong> </p>";
    echo "\nPDO::errorInfo():\n";
    print_r($pdo->errorInfo());
    exit();
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
              <?php $n=0; include("blocks/nav.php");
                //Выводим заметку
                $rating = $row['rating']/$row['q_vote'];
                $rating = intval($rating);

                printf ("<p class='post_title'>%s</p>
                  <p class='post_add'>Автор: %s</p>
                  <p class='post_add'>Дата: %s</p>
                  %s
                  <p class='post_view'>Количество просмотров: %s  |
                  Рейтинг: <img src='img/%s.gif' /></p>",
                  $row['title'], $row['author'], $row['date'], $row['text'],
                  $row['view'], $rating
                );
              ?>
              <form action='vote_res.php' method="post" name="vv">
                <p class='pvote'>Оцените заметку: 1<input name="score" type="radio" value="1">
                  2<input name="score" type="radio" value="2">
                  3<input name="score" type="radio" value="3">
                  4<input name="score" type="radio" value="4">
                  5<input name="score" type="radio" value="5" checked>
                  <input type="submit" name="submit" value="Оценить">
                  <input name="id" type="hidden" value="<?= $id; ?>">
                </p>

              </form>

              <?php
                //Вывод комментариев
                echo "<p class='post_comment'>Комментарии:</p>";
                $stmt3 = $pdo->prepare("SELECT * FROM comments WHERE post=:id");
                $stmt3->execute(['id' => $id]);

                If(isset($stmt3)) {
                  while ($row3 = $stmt3->fetch()) {
                    printf ("<div class='post_div'><p class='post_comment_add'>Комментарий добавил(а):
                    <strong>%s</strong> <br>
                      Дата: <strong>%s</strong></p>
                      <p>%s</p></div>",
                      $row3['author'], $row3['date'], $row3['text']
                    );
                  }
                }

                $stmt4 = $pdo->prepare("SELECT img FROM comments_setting");
                $stmt4->execute();
                $row4 = $stmt4->fetch();

               ?>

               <!-- Форма добавления комментария -->
               <p class='post_comment'>Добавьте Ваш комментарий:</p>
               <form action="comment.php" method="post" name="form_comm">
                 <p><label>Введите Ваше имя:</label>
                 <input type="text" name="author" size="30"></p>
                 <p><label>Введите текст комментария:</label><br>
                 <textarea name="text" cols="53" rows="5"></textarea></p>
                 <p>Введите указанную сумму с картинки:
                 <input type="text" name="pr" size="5"></p>
                 <p><img src="<?= $row4['img']; ?>" /></p>
                 <input type="hidden" name="id" value="<?= $id ?>">
                 <p><input type="submit" name="sub_com" value="Комментировать">
                 </p>
               </form>
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
