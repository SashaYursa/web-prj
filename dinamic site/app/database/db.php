<?php
session_start();
require('connect.php');

function tt($value){
  echo '<pre>';
  print_r($value);
  echo '</pre>';
 // exit();
}

// Помилки при отрииманні записів з бд
function dbCheckErrors($query){
  $errInfo = $query->errorInfo();
  if($errInfo[0] !== PDO::ERR_NONE){
    echo $errInfo[2];
    exit();
  }
  return true;
}


// Вибірка з таблиці всіх записів
function selectAll($table, $params = []){
  global $pdo;
  $sql = "SELECT * FROM $table";
  if(!empty($params)){
     $i = 0;
     foreach($params as $key => $val){
      if (!is_numeric($val)){
        $val = "'" . $val . "'";
      }
      if($i === 0){
          $sql = $sql . " WHERE $key=$val";
      }else{
        $sql = $sql . " AND $key=$val";
      } 
      $i++;
     }
  }

  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetchAll();
}


// Вибірка з таблиці 1-го запис
function selectOne($table, $params = []){
  global $pdo;
  $sql = "SELECT * FROM $table";
  if(!empty($params)){
     $i = 0;
     foreach($params as $key => $val){
      if (!is_numeric($val)){
        $val = "'" . $val . "'";
      }
      if($i === 0){
          $sql = $sql . " WHERE $key=$val";
      }else{
        $sql = $sql . " AND $key=$val";
      } 
      $i++;
     }
  }

  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetch();
}

// Запис в таблицю бд
function insert($table, $params){
  global $pdo;
  $i =0;
  $coll = '';
  $mask = '';
  foreach($params as $key => $val){
    if ($i === 0){
      $coll = $coll . $key;
      $mask = $mask . "'" . $val . "'";
    }else {
      $coll = $coll .', ' . $key;
      $mask = $mask . ', ' . "'" . $val . "'";
    }
    $i++;
  }
  $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
  $query = $pdo->prepare($sql);
  $query->execute($params);
  dbCheckErrors($query);
  return $pdo->lastInsertId();
}  

function update($table, $id, $params){
  global $pdo;
  $i =0;
  $str = '';
  foreach($params as $key => $val){
    if ($i === 0){
      $str = $str . $key . " = '" . $val . "'";
    }else {
      $str = $str . ", " . $key . '= ' . "'" . $val . "'";
    }
    $i++;
  }
  $sql = "UPDATE $table SET $str WHERE id = $id ";
  $query = $pdo->prepare($sql);
  $query->execute($params);
  dbCheckErrors($query);
}  

function delete($table, $id){
  global $pdo;
  $sql = "DELETE FROM $table WHERE id =" . $id;
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
}  
// Вибірка з автором
function selectAllFromPostsWithUsers($table1, $table2){
  global $pdo;
  $sql = "
  SELECT 
  t1.id,
  t1.title,
  t1.img,
  t1.content,
  t1.status,
  t1.id_topic,
  t1.created_date,
  t2.username
  FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user=t2.id";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetchAll();
}
// Вибірка з автором на головну сторінку
function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset){
  global $pdo;
  $sql = "
  SELECT 
  p.*, u.username
  FROM $table1 AS p JOIN $table2 AS u ON p.id_user=u.id WHERE p.status = 1 LIMIT $limit OFFSET $offset";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetchAll();
}
// Вибірка з автором в категорії
function selectAllFromPostsWithUsersOnIndexToCategory($table1, $table2, $limit, $offset, $category){
  global $pdo;
  $sql = "
  SELECT 
  p.*, u.username
  FROM $table1 AS p JOIN $table2 AS u ON p.id_user=u.id WHERE p.id_topic=$category AND p.status = 1 LIMIT $limit OFFSET $offset";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetchAll();
}

function countRowInCategory($table, $category){
  global $pdo;
  $sql = "
  SELECT 
  COUNT(*)
  FROM $table as p WHERE p.id_topic=$category";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetchColumn();
}

// Вибірка з автором на головну сторінку
function selectTopTopicFromPostsOnIndex($table1){
  global $pdo;
  $sql = "
  SELECT * FROM $table1 WHERE id_topic = 14";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetchAll();
}

// Пошук
function searchInTytleAndContent($text, $table1, $table2, $limit, $offset){
  $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
  global $pdo;
  $sql = "
  SELECT 
  p.*, u.username
  FROM $table1 AS p 
  JOIN $table2 AS u 
  ON p.id_user=u.id 
  WHERE p.status = 1 
  AND p.title LIKE '%$text%' OR p.content LIKE '%$text%' LIMIT $limit OFFSET $offset";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetchAll();
}
// Вибірка запису (posts) 
function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id){
  global $pdo;
  $sql = "
  SELECT 
  p.*, u.username
  FROM $table1 AS p JOIN $table2 AS u ON p.id_user=u.id WHERE p.id= $id";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetch();
}
// Вибірка запису (posts) 
function countRow($table){
  global $pdo;
  $sql = "
  SELECT 
  COUNT(*)
  FROM $table WHERE status = 1";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetchColumn();
}
// Вибірка записів пошуку (posts) 
function countRowInSearch($table, $text){
  global $pdo;
  $sql = "
  SELECT 
  COUNT(*)
  FROM $table WHERE status = 1 AND title LIKE '%$text%' OR content LIKE '%$text%'";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckErrors($query);
  return $query->fetchColumn();
}
?>