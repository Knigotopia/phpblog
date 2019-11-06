<?php

include("blocks/db.php");
//записываем значения полей посредством метода POST
$score = $_POST['score'];
$id = $_POST['id'];

$stmt = $pdo->prepare("SELECT rating, q_vote FROM data WHERE id=:id");
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();

$new_rating = $row['rating'] + $score;
$new_q_vote = $row['q_vote'] + 1;

$stmt2 = $pdo->prepare("UPDATE data SET rating=:new_rating, q_vote=:new_q_vote WHERE id=:id");
$stmt2->execute(['id' => $id, 'new_q_vote' => $new_q_vote, 'new_rating' => $new_rating]);

header("Refresh:0; url=view_post.php?id=$id");

?>
