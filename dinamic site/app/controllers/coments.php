<?php
// controller
include_once SITE_ROOT . "/app/database/db.php";
$commentsForAdm = selectAll('comments');

@$page = $_GET['post'];
$email = '';
$comment = '';
$errorMsg = [];
$status = 0;
$comments = [];
// Код для форми створення коментаря
if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['goComment'])){
  $email = trim($_POST['email']);
  $comment = trim($_POST['comment']);
 
  if($email === '' || $comment === ''){
    array_push($errorMsg, "Не всі поля заповнені");
  }elseif(mb_strlen($comment, 'UTF8') < 30){
    array_push($errorMsg, "Комент повинен бути більше 30-ти символів");
  }else{ 
    $user = selectOne('users', ['email']);
    if ($user['email'] == $email){
      $status = 1;
    }
    $comment = [
    'status' => $status,
    'page' => $page,
    'email' => $email,
    'comment' => $comment
    ];

   $comment = insert('comments', $comment);
   $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
  }
}else{
  $email = '';
  $comment = '';
  $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
}
// Видаленння коментаря
if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['delete_id'])){
  $id = $_GET['delete_id'];
  delete('comments', $id);
  header('location: ' . BASE_URL . 'admin/coments/index.php');
}

// Статус публікації
if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['pub_id'])){
  $id = $_GET['pub_id'];
  $publish = $_GET['publish'];

  $postId = update('comments', $id, ['status' => $publish]);

  header('location: ' . BASE_URL . 'admin/coments/index.php');
  exit();
}

// Редагування коментаря

if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['id'])){
  $comment = selectOne('comments', ['id' => $_GET['id']]);
  
  $id = $comment['id'];
  $email = $comment['email'];
  $text = $comment['comment'];
  $publish = $comment['status'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['edit_comment'])){
  $id = $_POST['id'];
  $text = trim($_POST['content']);
  $publish = isset($_POST['publish'])? 1 : 0;

  if($text === ''){
    array_push($errorMsg, "ЗАПОВНІТЬ ОДНЕ ПОЛЕ!!!");
    $id = $_POST['id'];
    $text = trim($_POST['content']);
    $publish = isset($_POST['publish'])? 1 : 0;
  }
  else{
    $com = [
      'comment' => $text,
      'status' => $publish
      ];

   $comment = update('comments', $id, $com);
   header('location: ' . BASE_URL . 'admin/coments/index.php');
  }
}