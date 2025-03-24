<!DOCTYPE html>
<html lang="en">
<?php
    include 'db.php'; 

    $query = $conn->prepare("SELECT * FROM tasks WHERE is_completed = 0");
    $query->execute();
    $tasks = $query->fetchAll();

    $query = $conn->prepare("SELECT * FROM tasks WHERE is_completed = 1");
    $query->execute();
    $completedTasks = $query->fetchAll();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="/style/style.css">
</head>
<body>
    <aside>
        <h1>Todo List</h1>
        <ul>
            <li><a href="#">New Task</a></li>
        </ul>
        <div>
            <a href="/logout.php" style="color:white">Logout</a>
        </div>
    </aside>

    <main>
        <h2>New Task</h2>
        <form action="add_task.php" method="POST">
            <input type="text" name="addtask" placeholder="Enter a new task" required>
            <button type="submit">Add Task</button>

        </form>


        <h3>Task Lists</h3>
        <ul class="task-list">
            <?php
                if (!empty($tasks)) {
                    foreach ($tasks as $task) {
                        echo "<li>{$task['task_name']}
                                <div>
                                    <a href='complete_task.php?id={$task['id']}' class='complete'>Complete</a>
                                    <a href='delete_task.php?id={$task['id']}' class='delete'>Delete</a>
                                </div>
                            </li>";
                    }
                } else {
                    echo "<li>No tasks yet.</li>";
                }
            ?>
        </ul>

        <h3>Completed Tasks</h3>
        <ul class="completed-tasks">
            <?php
            if (!empty($completedTasks)) {
                foreach ($completedTasks as $task) {
                    echo "<li><s>{$task['task_name']}</s>
                            <a href='delete_task.php?id={$task['id']}' class='delete'>Delete</a>
                        </li>";
                }
            } else {
                echo "<li>No completed tasks yet.</li>";
            }
            ?>
        </ul>

    </main>
</body>
</html>
