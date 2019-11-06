<?php

include("blocks/db.php");



$cat = $_GET['cat'];
if (!isset($cat)) {
  $cat = 1;
}

/* Проверяем, является ли переменная числом */
if (!preg_match("|^[\d]+$|", $cat)) {
exit("<p>Неверный формат запроса! Проверьте URL!");
}

$sql = "SELECT COUNT(*) FROM categories";
$stmt = $pdo->prepare($sql);
if ($stmt->execute()) {

  if ($stmt->fetchColumn() > 0) {
    $stmt = $pdo->prepare('SELECT * FROM categories WHERE id=:cat');
    $stmt->execute(['cat' => $cat]);
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
    exit();
}
?>


<html>
<head>
  <meta name="description" content="<?= $row['meta_d']; ?>">
  <meta name="keywords" content="<?= $row['meta_k']; ?>">
  <meta charset="utf-8" content="text/html" http-equiv="content-type">
  <title><?= "Заметки категории - $row[title]"; ?></title>
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
                echo $row['text'];
                //Постраничная навигация

                $num = 3; //кол-во постов на странице
                $page = $_GET['page'];
                $stm = $pdo->prepare("SELECT COUNT(*) FROM data");
                $stm->execute();
                $posts = $stm->fetchColumn();
                $total = (($posts - 1) / $num) + 1;
                $total = intval($total);
                $page = intval($page);
                if(empty($page) or $page < 0) {
                    $page = 1;
                }

                if($page > $total) {
                    $page = $total;
                }
                $start = $page * $num - $num;

                $cat = $_GET['cat'];
                $stmt = $pdo->prepare("SELECT mini_img,id,title,date,author,view,
                  description, rating, q_vote FROM data WHERE cat=:cat
                  ORDER BY id LIMIT $start, $num");
                $stmt->execute(['cat' => $cat]);

              while ($row = $stmt->fetch()) {

                $rating = $row['rating']/$row['q_vote'];
                $rating = intval($rating);

                printf ("<table class='post' align='center'>
                            <tr>
                              <td class='post_title'>
                              <p class='post_name'>
                              <img align='left' src='%s' />
                              <a href='view_post.php?id=%s'>%s</a></p>
                              <p class='post_adds'>Дата добавления: %s</p>
                              <p class='post_adds'>Автор урока: %s</p>
                              <p class='post_adds'>Просмотров: %s |
                              Рейтинг: <img src='img/%s.gif' /></p>
                              </td>
                            </tr>
                            <tr>
                              <td><p>%s</p></td>
                            </tr>

                          </table><br><br>", $row["mini_img"], $row["id"], $row["title"], $row["date"],
                          $row["author"], $row["view"], $rating, $row["description"]);

                          // Проверяем нужны ли стрелки назад
                          if ($page != 1) $pervpage = '<a href=view_cat.php?cat='.$cat.'&page=1>Первая</a> | <a href=view_cat.php?cat='.$cat.'&page='. ($page - 1) .'>Предыдущая</a> | ';
                          // Проверяем нужны ли стрелки вперед
                          if ($page != $total) $nextpage = ' | <a href=view_cat.php?cat='.$cat.'&page='. ($page + 1) .'>Следующая</a> | <a href=view_cat.php?cat='.$cat.'&page=' .$total. '>Последняя</a>';

                          // Находим две ближайшие страницы с обоих краев, если они есть
                          if($page - 5 > 0) $page5left = ' <a href=view_cat.php?cat='.$cat.'&page='. ($page - 5) .'>'. ($page - 5) .'</a> | ';
                          if($page - 4 > 0) $page4left = ' <a href=view_cat.php?cat='.$cat.'&page='. ($page - 4) .'>'. ($page - 4) .'</a> | ';
                          if($page - 3 > 0) $page3left = ' <a href=view_cat.php?cat='.$cat.'&page='. ($page - 3) .'>'. ($page - 3) .'</a> | ';
                          if($page - 2 > 0) $page2left = ' <a href=view_cat.php?cat='.$cat.'&page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
                          if($page - 1 > 0) $page1left = '<a href=view_cat.php?cat='.$cat.'&page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';

                          if($page + 5 <= $total) $page5right = ' | <a href=view_cat.php?cat='.$cat.'&page='. ($page + 5) .'>'. ($page + 5) .'</a>';
                          if($page + 4 <= $total) $page4right = ' | <a href=view_cat.php?cat='.$cat.'&page='. ($page + 4) .'>'. ($page + 4) .'</a>';
                          if($page + 3 <= $total) $page3right = ' | <a href=view_cat.php?cat='.$cat.'&page='. ($page + 3) .'>'. ($page + 3) .'</a>';
                          if($page + 2 <= $total) $page2right = ' | <a href=view_cat.php?cat='.$cat.'&page='. ($page + 2) .'>'. ($page + 2) .'</a>';
                          if($page + 1 <= $total) $page1right = ' | <a href=view_cat.php?cat='.$cat.'&page='. ($page + 1) .'>'. ($page + 1) .'</a>';
              }

  // Вывод меню, если страниц больше одной

  if ($total > 1)
  {
  Error_Reporting(E_ALL & ~E_NOTICE);
  echo "<div class='pstrnav'>";
  echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
  echo "</div>";
}
               ?>
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
