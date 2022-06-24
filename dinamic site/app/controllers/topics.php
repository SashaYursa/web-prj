<?php

include SITE_ROOT . '/app/database/db.php';


$errorMsg = [];
$id = '';
$name = '';
$description = '';


$alltopics = selectAll('topics');

// Форма створення категорій
if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['topic-create'])){
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  
  if($name === '' || $description === ''){
    array_push($errorMsg,"Не всі поля заповнені");
  }elseif(mb_strlen($name, 'UTF8') < 2){
    array_push($errorMsg, "Ім'я категорії повинно бути більше 2 символів");
  }else{
    $existance = selectOne('topics', ['name' => $name]);
    if($existance){
      array_push($errorMsg, "Така категорія вже наявна");
    }else{
    $topic = [
    'name' => $name,
    'description' => $description
    ];
   $id = insert('topics', $topic);
   $topic = selectOne('topics', ['id' => $id]);
   header('location: ' . BASE_URL . 'admin/topics/index.php');
  }
}
}else{
  $name = '';
  $description = '';
}

// Редагування категорій

if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['id'])){
  $id = $_GET['id'];
  $topic = selectOne('topics', ['id' => $id]);
  $id = $topic['id'];
  $name = $topic['name'];
  $description = $topic['description'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['topic-edit'])){
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  
  if($name === '' || $description === ''){
    array_push($errorMsg, "Не всі поля заповнені");
  }elseif(mb_strlen($name, 'UTF8') < 2){
    array_push($errorMsg, "Ім'я категорії повинно бути більше 2 символів");
  }elseif(selectOne('topics', ['name' => $name])['id']!= $id){
    array_push($errorMsg, "Таке ім'я категорії вже існує");
  }
  else{
    $topic = [
    'name' => $name,
    'description' => $description
    ];
   $id = $_POST['id'];
   $topic_id = update('topics', $id, $topic);
   header('location: ' . BASE_URL . 'admin/topics/index.php');
  }
}

// Видалення категорій
if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['del_id'])){
  $id = $_GET['del_id'];
  delete('topics', $id);
  header('location: ' . BASE_URL . 'admin/topics/index.php');
}
