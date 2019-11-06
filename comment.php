<?php

include("blocks/db.php");
//записываем значения полей посредством метода POST в переменную data
$data = $_POST;

//Проверка на пустые поля автор и текст
if(isset($data['sub_com'])) {
  if(isset($data['author'])) {
    trim($data['author']);
  } else {
    $data['author'] = "";
  }

  if(isset($data['text'])) {
    trim($data['text']);
  } else {
    $data['text'] = "";
  }

//Если автор или текст пустой, то выводим ошибку
  if(empty($data['author']) || empty($data['text']) ) {
    exit("<p>Вы ввели не всю информацию, вернитесь назад и заполните все поля.
      <br><input type='button' value='Вернуться' name='back'
      onclick='javascript:history.back()'></p>");
  }
//Удаляем экранирующие символы и html-тэги из текста
  $data['author'] = stripslashes($data['author']);
  $data['text'] = stripslashes($data['text']);
  $data['author'] = htmlspecialchars($data['author']);
  $data['text'] = htmlspecialchars($data['text']);
//Проверка совпадения на сумму (капча)
  $stmt = $pdo->prepare("SELECT sum FROM comments_setting");
  $stmt->execute();
  $row = $stmt->fetch();


  if ($data['pr'] == $row['sum']) {
    //Заносим комментарий в базу
    $date = date('Y-m-d');
    $sql = "INSERT INTO comments (post, author, text, date)
    VALUES (:id, :author, :text, :date)";
    $stmt5 = $pdo->prepare($sql);
    $stmt5->execute([':id' => $data['id'], ':author' => $data['author'],
    ':text' => $data['text'], ':date' => $date]);

    //Отправка админу письма с уведомлением о новом комменте
    $sql2 = "SELECT title FROM data WHERE id = :id";
    $stmt6 = $pdo->prepare($sql2);
    $stmt6->execute(['id' => $data['id']]);
    $row6 = $stmt6->fetch();
    $post_title = $row6['title'];

    $id = $_POST['id'];
    $address = "sorok@ukr.net";
    $subject = "Новый коммент на блоге";
    $message = "Появился новый комментарий к заметке: ". $post_title."\n
    Комментраий добавил(а): ".$data['author']."\n
    Текст комментария: ".$data['text']."\n
    Ссылка на заметку: http://phpblog/view_post.php?id=".$data['id']."";
    mail($address, $subject, $message, "Content-type: text/plain;
    Charset=windows-1251\r\n");

    header("Refresh:0; url=view_post.php?id=$id");

    if ($stmt5) {
      echo "<p>Данные занесены в таблицу!</p>";
    } else {
      echo "<p>Ошибка! Урок не добавлен в базу.</p>";
    }
  } else {
    exit("<p>Вы ввели неверную сумму с картинки!<br><input type='button'
    value='Вернуться' name='back' onclick='javascript:history.back()'></p>");
  }



}



?>
