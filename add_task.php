<?php
include "db.php"; 

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addtask'])) {
    $addtask = trim($_POST['addtask']); 
    if (!empty($addtask)) {
        $query = $conn->prepare("INSERT INTO tasks (task_name) VALUES (:adtask)");
        $query->bindParam(":adtask", $addtask, PDO::PARAM_STR);
        try {
            $query->execute();
            header("Location: index.php"); 
            exit();
        } catch (Exception $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    } else {
        echo "Task name cannot be empty.";
    }
} else {
    echo "Invalid request.";
}
?>
