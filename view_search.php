<?php

include("blocks/db.php");

$search = $_POST['search'];
$submit_s = $_POST['submit_s'];

$search = trim($search);
$search = stripslashes($search);
$search = htmlspecialchars($search);
var_dump($search);

if (isset($submit_s)) {
  if (empty($search) || strlen($search) < 4) {
    exit("<p>Поисковый запрос не введен, либо он менее 4-х символов</p>");
  }
} else {
  exit("<p>Вы обратались к файлу без необходимых параметров</p>");
}

?>

<html>
<head>
  <meta charset="utf-8" content="text/html" http-equiv="content-type">
  <title><?= "Заметки по запросу - $search"; ?></title>
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
              <?php

                echo $search = "%$search%";
                $n=0; include("blocks/nav.php");
                $stmt = $pdo->prepare("SELECT mini_img,id,title,date,author,view,
                  description,rating, q_vote FROM data WHERE text LIKE :search");
                $stmt->execute(['search' => $search]);


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
