<?php
require_once("connection.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css"> 
    <title>Admin</title>
</head>
<body>
    <div class="header"></div>
    <div class="logo"><img src="logo_.png" alt="logo" width="120px" height="90px"></div>
    <h1>Welcome Back</h1>    

    <!-- <p>Add a description to your project</p> -->
    <!-- replace the commented parts to make it look better -->
    
    <form class="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" class="title" name="title" placeholder="title of your project.." required><br><br>
        <input type="text" class="date" name="date" placeholder="start- and end date of your project..." required><br><br>
        <input type="text" class="description" name="description" placeholder="description of your project..." required><br><br>

        <!-- -->
        <!-- <p>Finally, select a template: </p> -->
        <div class="button">
            <button type="submit" name="btn_submit" value="1">Template 1</button>
            <button type="submit" name="btn_submit" value="2">Template 2</button>
            <button type="submit" name="btn_submit" value="3">Template 3</button>
            <button type="submit" name="btn_submit" value="4">Template 4</button>
        </div>
    </form>

<?php
require_once("connection.inc.php"); // Adjust the path if necessary

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_submit'])) {

    $title       = $_POST["title"];
    $date        = $_POST["date"];
    $description = $_POST["description"];
    $template_id = $_POST["btn_submit"];

    try {
        $sql = "INSERT INTO tb_projects (title, date, description, template_id) VALUES (?, ?, ?, ?)";
        $params = [$title, $date, $description, $template_id];

        getData($sql, $params);

        echo "Data sent successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
</body>
</html>