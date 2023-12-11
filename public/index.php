<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../View/Style.css">
    <title>Notes</title>
</head>
<body>
<?php
include '../Controller/CardController.php';
$cardList = new CardController();
echo '<div class="base">';
echo '<h1 style="text-align: center">Notes</h1>';
echo '<div class="container">';
foreach ($cardList->CardList as $index => $note) {
    echo '<div class="card" id="card_' . $index . '">';
    echo '<h2>' . $note->header . '</h2>';
    echo '<p>' . $note->text . '</p>';
    echo '<br>';
    echo '<p>Creation Date: ' . $note->date . '</p>';
    echo '<button onclick="deleteCard(' . $index . ')">Delete</button>';

    echo '</div>';
}
echo '</div>';
echo '<a href="../View/AddNote.php">Add notes</a>';
echo '</div>';
?>
<script>
    function deleteCard(index) {
        var confirmation = confirm("Are you sure you want to delete this note?");
        if (confirmation) {
            window.location.href = '../Controller/Delete-card.php?index=' + index;
        }
    }
</script>
</body>
</html>