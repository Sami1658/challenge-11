<?php
require_once('connection.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="project.css"> 
    <title>Project</title>
</head>
<body>

    <div class="header"></div>
    <div class="logo"><img src="logo_.png" alt="logo" width="120px" height="90px"></div>

<div class="projects_obj">
<?php

$project_id = isset($_GET["project_id"]) && is_numeric($_GET["project_id"]) ? intval($_GET['project_id']) : 0;


if ($project_id > 0) {
    try {
        $result = getData("SELECT * FROM tb_projects WHERE project_id = ?", [$project_id]);
        echo !empty($result) ? implode('<br>', array_map(function($row) {

            return '<span class="title">' . htmlspecialchars($row['title']) . '</span><br><br>' . 
                   '<span class="date">' . htmlspecialchars($row['date']) . '</span><br><br>' . 
                   '<span class="description">' . htmlspecialchars($row['description']) . '</span>' .
                   '<br><br><a href="' . ($row['link']) . '" target="_blank">Click here to see the website</a>';

        }, $result)) : "No records found.";    
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
} else {
    echo "Invalid or missing ID.";

}
?>
</div>

</body>
</html>
