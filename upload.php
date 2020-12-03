<?php
if (isset($_POST['#submitFormData'])) {
    $task = $_POST['task'];
    mysqli_query($con, "INSERT INTO tasks (task, user_id) VALUES (`$task`, `$current_id`)");
}

echo "ENVIADO COM SUCESSOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO";
