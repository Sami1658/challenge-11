<?php
    require_once("connection.inc.php");

    $sql    = "SELECT * FROM tb_projects";
    $result = getData($sql); //Database::
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css"> 
    <title>Main Page</title>
</head>
<body>

    <div class="header"></div>
    <div class="logo"><img src="logo_.png" alt="logo" width="120px" height="90px"></div>
   
    <div class="PageLink">
        <a href="main.php" class="main_link">Main Page</a>
        <a href="about_me.php" class="about_link">About Me</a>
        <a href="contact.php" class="contact_link">Contact</a>
    </div>

    <div class="main_text">
        <h1></h1>
        <p></p>
    </div>

    <div class="projects">
        <?php
            foreach($result as $key => $row){

                $project_id = $row['project_id'];
                print '<span class="title">' . $row['title'] . '</span>';
                print "</br>";
                print "<a href='project.php?project_id=$project_id'>Klik hier</a>";
                print "</br>";
            }

        ?>
    </div>

</body>
</html>