<td width="182" class="left" valign="top">
  <p align="center" class="title">Категории</p>
  <div id="coolmenu">
<?php
  $stmt2 = $pdo->prepare('SELECT * FROM categories');
  $stmt2->execute();
  while ($row2 = $stmt2->fetch()) {

    printf("<p><a href='view_cat.php?cat=%s'>%s</a></p>", $row2['id'], $row2['title']);
  }


?>
  </div>
    <p align="center" class="title">Последние заметки</p>
    <div id="coolmenu">
<?php
    $stmt3 = $pdo->prepare('SELECT id,title FROM data ORDER BY date DESC LIMIT 5');
    $stmt3->execute();
    while ($row3 = $stmt3->fetch()) {

      printf("<p><a href='view_post.php?id=%s'>%s</a></p>", $row3['id'], $row3['title']);
    }
?>
      </div>
  <p align="center" class="title">Архив</p>
  <div id="coolmenu">
<?php
  $stmt4 = $pdo->prepare('SELECT DISTINCT left(date,7) as month FROM data
    ORDER BY month DESC');
  $stmt4->execute();
  while ($row4 = $stmt4->fetch()) {

    printf("<p><a href='view_date.php?date=%s'>%s</a></p>", $row4['month'], $row4['month']);
  }
?>
  </div>
  <p align="center" class="title">Блоги друзей</p>
  <div id="coolmenu">
<?php
  $stmt5 = $pdo->prepare('SELECT link,title FROM friends_blog');
  $stmt5->execute();
  while ($row5 = $stmt5->fetch()) {

    printf("<p><a href='%s' target='_blank'>%s</a></p>", $row5['link'], $row5['title']);
  }
?>
  </div>

  <p align="center" class="title">Поиск</p>
  <div id="coolmenu">
    <form name="form_s" method="post" action="view_search.php">
      <p class="search_t"> Запрос должен быть не менее 4-х символов</p>
      <p><input type="text" name="search"></p>
      <p><input class="search_btn" type="submit" name="submit_s" value="Поиск"></p>
    </form>
  </div>

  <p align="center" class="title">Статистика</p>
  <div id="coolmenu">
    <?php

    $stat = $pdo->prepare("SELECT COUNT(*) FROM data");
    $stat->execute();
    $total_posts = $stat->fetchColumn();
    echo "<p class='stat'>Всего заметок: $total_posts</p>";

    $stat2 = $pdo->prepare("SELECT COUNT(*) FROM comments");
    $stat2->execute();
    $total_comments = $stat2->fetchColumn();
    echo "<p class='stat'>Всего комментариев: $total_comments</p>";

    $stat3 = $pdo->prepare("SELECT SUM(view) FROM data");
    $stat3->execute();
    $total_comments = $stat3->fetchColumn();
    echo "<p class='stat'>Всего просмотров заметок: $total_comments</p>";

    ?>
  </div>
</td>
