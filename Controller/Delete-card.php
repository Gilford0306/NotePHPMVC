<?php
include 'CardController.php';
if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $cardList = new CardController();
    $cardList->deleteCard($index);
    header("Location: ../public/index.php");
    exit();
} else {
    header("Location: ../public/index.php");
    exit();
}
?>