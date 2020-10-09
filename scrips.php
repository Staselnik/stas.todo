<?php

$host = 'localhost';
$dbname = 'todo';
$login = 'root';
$password = 'root';

$db = getDbConnect($host, $dbname, $login, $password);

// Установка соединения с БД
function getDbConnect($host, $dbname, $login, $password){
    $db = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
    $db->exec("SET CHARACTER SET utf8");
    return $db;
}

// Функция для получения из БД
function getData($db, $sql){
    $stmt = $db->query($sql);
    $rows = $stmt->fetchAll();
    return $rows;
}

// Получает все списки и их таски
function getListsData($db){
    $lists = getData($db, "SELECT * FROM `lists`");
    foreach($lists as $list_key => $list){
        $tasks = getData($db, "SELECT * FROM `tasks` WHERE `list_id` = " . $list['id'] . ' ORDER BY `num`');
        $lists[$list_key]['tasks'] = $tasks;
    }
    return $lists;
}

// Управление списками
function addList($db, $list_name = ''){
    $sql = "INSERT INTO `lists` (`name`) VALUES ('$list_name')";
    $db->query($sql);
}
function editList($db, $list_id, $list_name){
    $sql = "UPDATE `lists` SET `name` = '$list_name' WHERE `id` = $list_id";
    $db->query($sql);
}
function deleteList($db, $list_id){
    $sql = "DELETE FROM `lists` WHERE `id` = $list_id";
    $db->query($sql);
    
    $sql = "DELETE FROM `tasks` WHERE `list_id` = $list_id";
    $db->query($sql);
}

// Управление тасками
function addTask($db, $list_id, $task_num, $task_name){
    $sql = "INSERT INTO `tasks` (`list_id`, `num`, `name`) VALUES ($list_id, '$task_num', '$task_name')";
    $db->query($sql);
}
function editTask($db, $task_id, $list_id, $task_num, $task_name, $task_ended){
    $sql = "UPDATE `tasks` SET `list_id` = '$list_id', `num` = '$task_num', `name` = '$task_name', `ended` = '$task_ended' WHERE `id` = $task_id";
    $db->query($sql);
}
function deleteTask($db, $task_id){
    $sql = "DELETE FROM `tasks` WHERE `id` = $task_id";
    $db->query($sql);
}
?>