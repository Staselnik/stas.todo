<?php
// Подключение файла со скриптами
require_once('./functions.php');

if($_POST['add_list']){
    addList($db, $_POST['name']);
}
elseif($_POST['remove_list']){
    deleteList($db, $_POST['id']);
}
elseif($_POST['edit_list']){
    editList($db, $_POST['id'], $_POST['name']);
}
elseif($_POST['add_task']){
    addTask($db, $_POST['list_id'], $_POST['num'], $_POST['name']);
}
elseif($_POST['remove_task']){
    deleteTask($db, $_POST['id']);
}
elseif($_POST['edit_task']){
    editTask($db, $_POST['id'], $_POST['list_id'], $_POST['num'], $_POST['name'], $_POST['ended']);
}