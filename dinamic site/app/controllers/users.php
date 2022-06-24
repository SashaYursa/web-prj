<?php
include SITE_ROOT . '/app/database/db.php';

$errorMsg = [];


function createSession($id, $login, $admin){
  $_SESSION['id'] = $id;
  $_SESSION['login'] = $login;
  $_SESSION['admin'] = $admin;
  if($_SESSION['admin']){
   header('location: ' . BASE_URL . 'admin/posts/index.php');
  }else{
    header('location: ' . BASE_URL);
  }
}

$users = selectAll('users');

// Реєстрація
if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['button-reg'])){
  $admin = 0;
  $login = trim($_POST['login']);
  $email = trim($_POST['email']);
  $passF = trim($_POST['password']);
  $passS = trim($_POST['password-submit']);  
  
  if($login === '' || $email === '' || $passS === '' || $passF === ''){
    array_push($errorMsg, "Не всі поля заповнені");
  }elseif(mb_strlen($login, 'UTF8') < 2){
    array_push($errorMsg, "Логін повинен бути більше 2 символів");
  }elseif ($passS !== $passF){
    array_push($errorMsg, "Паролі не співпадають");
  }else{
    $existance = selectOne('users', ['email' => $email]);
    if($existance){
      array_push($errorMsg, "Користувач з такою поштою вже існує");
    }else{
    $pass = password_hash($passF, PASSWORD_DEFAULT);
    $post = [
    'admin' => $admin,
    'username' => $login,
    'email' => $email,
    'password' => $pass,
    ];
   $id = insert('users', $post);
   $user = selectOne('users', ['id' => $id]);
   createSession($user['id'], $user['username'], $user['admin']);
  }
}
}else{
    $login = '';
    $email = '';
}
// Авторизація
  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);
    if($email === '' || $pass === ''){
      array_push($errorMsg, "Не всі поля заповнені");
    }else{
      $existance = selectOne('users', ['email' => $email]);
      if($existance && password_verify($pass, $existance['password'])){
        createSession($existance['id'], $existance['username'], $existance['admin']);
      }
      else{
        array_push($errorMsg, "Помилка при авторизації");
      }
    }
  }else{
    $email = '';
  }



  // Код додавання користувача в адмінці
if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['create-user'])){
  
  
  $admin = 0;
  $login = trim($_POST['login']);
  $email = trim($_POST['email']);
  $passF = trim($_POST['password']);
  $passS = trim($_POST['password-submit']);  
  
  if($login === '' || $email === '' || $passS === '' || $passF === ''){
    array_push($errorMsg, "Не всі поля заповнені");
  }elseif(mb_strlen($login, 'UTF8') < 2){
    array_push($errorMsg, "Логін повинен бути більше 2 символів");
  }elseif ($passS !== $passF){
    array_push($errorMsg, "Паролі не співпадають");
  }else{
    $existance = selectOne('users', ['email' => $email]);
    if($existance){
      array_push($errorMsg, "Користувач з такою поштою вже існує");
    }else{
    $pass = password_hash($passF, PASSWORD_DEFAULT);
    if (isset($_POST['admin']))$admin = 1;
    $usr = [
    'admin' => $admin,
    'username' => $login,
    'email' => $email,
    'password' => $pass,
    ];
   $id = insert('users', $usr);
   $user = selectOne('users', ['id' => $id]);
   createSession($user['id'], $user['username'], $user['admin']);
  }
}
}else{
    $login = '';
    $email = '';
}

//Delete user
if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['delete_id'])){
  $id = $_GET['delete_id'];
  delete('users', $id);
  header('location: ' . BASE_URL . 'admin/users/index.php');
}

if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['id'])){
  $post = selectOne('posts', ['id' => $_GET['id']]);
  
  $id = $post['id'];
  $title = $post['title'];
  $content = $post['content'];
  $topic_id = $post['id_topic'];
  $publish = $post['status'];
}
// Редагування користувача через адмін панель
if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['edit_id'])){
  $user = selectOne('users', ['id' => $_GET['edit_id']]);

  $id = $user['id'];
  $admin = $user['admin'];
  $username = $user['username'];
  $email = $user['email'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['update-user'])){
  
  $id = $_POST['id'];
  $mail = trim($_POST['email']);
  $login = trim($_POST['login']);
  $passF = trim($_POST['password']);
  $passS = trim($_POST['password-submit']);
  $admin = isset($_POST['admin'])? 1 : 0;

  if($login === ''){
    array_push($errorMsg, "Не всі поля заповнені");
  }elseif(mb_strlen($login, 'UTF8') < 2){
    array_push($errorMsg, "Логін повинен бути більше 2-х символів");
  }elseif($passF !== $passS){
    array_push($errorMsg, "Паролі не співпадають");
  }else{
    $pass = password_hash($passF, PASSWORD_DEFAULT);
    if (isset($_POST['admin']))$admin = 1;
    $usr = [
    'admin' => $admin,
    'username' => $login,
    'password' => $pass
    ];
   $user = update('users', $id, $usr);
   header('location: ' . BASE_URL . 'admin/users/index.php');
  }
}else{
 $login = '';
 $mail = '';
}

// if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['pub_id'])){
//   $id = $_GET['pub_id'];
//   $publish = $_GET['publish'];

//   $postId = update('posts', $id, ['status' => $publish]);

//   header('location: ' . BASE_URL . 'admin/posts/index.php');
//   exit();
// }

?>
