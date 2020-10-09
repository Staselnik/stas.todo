<?php
// Подключение файла со скриптами
require_once('./functions.php');
$lists = getListsData($db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ToDo</title>

    <!-- CSS & Fonts -->
    <link rel="stylesheet" href="./css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="./css/font-awesome-4.7.0.css">
    <link rel="stylesheet" href="./css/style.css">

    <link rel="stylesheet" href="./css/jquery-ui.min.css">
    <style>
        .tasks {
            min-height: 20px;
            padding-bottom: 5px;
        }

        .ui-state-highlight {
            min-height: 50px;
        }

    </style>
</head>

<body>
    <div class="background"></div>

    <header>
        <h1>SIMPLE TODO LISTS</h1>
        <p>FROM RUBY GARAGE</p>
    </header>

    <div class="content">
        <div class="lists">
            <?php foreach($lists as $list): ?>
            <section class="list" data-listId="<?php echo $list['id']; ?>">
                <div class="list_head">
                    <i class="icons icon_main fa fa-calendar" aria-hidden="true"></i>
                    <h2><?php echo $list['name']; ?></h2>
                    <i class="icons icon_control edit fa fa-pencil" aria-hidden="true"></i>
                    <i class="icons icon_control remove fa fa-trash" aria-hidden="true"></i>
                </div>
                <div class="list_add_block">
                    <i class="icons plus fa fa-plus" aria-hidden="true"></i>
                    <input type="text" class="add_task_name" placeholder="Start taping here to create a task...">
                    <input type="button" class="add_task_sub" value="Add Task">
                </div>
                <div class="tasks">
                    <?php foreach($list['tasks'] as $task): ?>
                    <div data-taskId="<?php echo $task['id']; ?>" data-taskNum="<?php echo $task['num']; ?>" class="task_one">
                        <div class="task_check">
                            <input <?php echo ($task['ended'] == '1'?'checked':''); ?> id="task<?php echo $task['id']; ?>" type="checkbox">
                        </div>
                        <label for="task<?php echo $task['id']; ?>" class="task_name"><?php echo $task['name']; ?></label>
                        <nobr class="task_controls">
                            <i class="icons move fa fa-arrows" aria-hidden="true"></i>
                            <i class="icons edit fa fa-pencil" aria-hidden="true"></i>
                            <i class="icons remove fa fa-trash" aria-hidden="true"></i>
                        </nobr>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endforeach; ?>
            <section class="list empty_list">
                <div class="list_head">
                    <i class="icons icon_main fa fa-calendar" aria-hidden="true"></i>
                    <h2>New List</h2>
                    <i class="icons icon_control edit fa fa-pencil" aria-hidden="true"></i>
                    <i class="icons icon_control remove fa fa-trash" aria-hidden="true"></i>
                </div>
                <div class="list_add_block">
                    <i class="icons plus fa fa-plus" aria-hidden="true"></i>
                    <input type="text" class="add_task_name" placeholder="Start taping here to create a task...">
                    <input type="button" class="add_task_sub" value="Add Task">
                </div>
                <div class="tasks">
                    <div data-taskNum="0" class="task_one">
                        <div class="task_check">
                            <input id="task1" type="checkbox">
                        </div>
                        <label for="task1" class="task_name"></label>
                        <nobr class="task_controls">
                            <i class="icons move fa fa-arrows" aria-hidden="true"></i>
                            <i class="icons edit fa fa-pencil" aria-hidden="true"></i>
                            <i class="icons remove fa fa-trash" aria-hidden="true"></i>
                        </nobr>
                    </div>
                </div>
            </section>
        </div>
        <div class="controls">
            <button class="add_list">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span>Add TODO List</span>
            </button>
        </div>
    </div>

    <footer>
        <p class="copyright">&copy; Ruby Garage</p>
    </footer>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="./js/script.js"></script>
    <script>
        $('.tasks').sortable({
            placeholder: "ui-state-highlight",
            handle: '.move',
            axis: "y",
            update: function(event, ui) {
                setTaskNum($(this));
            },
        }).disableSelection();

    </script>
</body>

</html>
