<?php
session_start();
include('imports/connection.php');
include('imports/header.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <title>Document</title>
</head>

<body>
    <div class="lista-proc">
        <h2>Lista de Procrastinação</h2>

        <ul>
            <?php
            if ($current_id == $id) {
                $sql = "SELECT username, id FROM accounts;";
                $task = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($task)) { ?>
                    <br>
                    <li><a href="home.php?id=<?php echo $row['id']; ?>"><?php echo $row['username']; ?></a></li>
            <?php    }
            }
            ?>
        </ul>
    </div>
    </div>

</body>

</html>