<?php

include("blocks/db.php");
if (isset($_GET['date'])) {
  $date = $_GET['date'];
} else {
  exit("<p>Вы обратились к файлу без необходимых параметров</p>");
}

$date_title = $date;
$date_begin = $date;
$date++;
$date_end = $date;

$date_begin = $date_begin . "-01";
$date_end = $date_end . "-01";


?>


<html>
<head>
  <meta charset="utf-8" content="text/html" http-equiv="content-type">
  <title><?= "Заметки за $date_title"; ?></title>
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


                $stmt = $pdo->prepare("SELECT mini_img,id,title,date,author,view,
                  description,rating, q_vote FROM data WHERE date>:date_begin AND date<:date_end
                  ORDER BY date DESC");
                $stmt->execute(['date_begin' => $date_begin, 'date_end' => $date_end]);

                while ($row = $stmt->fetch()) {

                  $rating = $row['rating']/$row['q_vote'];
                  $rating = intval($rating);

                  printf ("<br><table class='post' align='center'>
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
