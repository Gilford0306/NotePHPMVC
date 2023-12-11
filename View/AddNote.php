<?php
include '../Controller/CardController.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newTitle = $_POST["title"];
    $newText = $_POST["text"];
    $cardController = new CardController();
    $cardController->CreateCard($newTitle,$newText);
    header("Location: ../public/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Добавить заметку</title>
</head>
<body>
<div class="form-container">
    <form method="post" action="">
        <label for="title">Header:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="text">Text:</label>
        <textarea name="text" id="text" d></textarea>
        <button class="button-wrapper" type="submit">Add Note</button>
    </form>
    <a href="../public/index.php">All Note</a>
</div>

</body>
</html>
