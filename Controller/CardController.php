<?php
include '../Model/Card.php';

class CardController {
    public $CardList = array();
    private $pdo;

    public function __construct()
    {
        $this->connectToDatabase();
        $this->fetchCardsFromDatabase();
    }

    private function connectToDatabase()
    {
        $host = "127.0.0.1";
        $database = "notedatabase";
        $username = "root";
        $password = "";

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    private function fetchCardsFromDatabase()
    {
        $stmt = $this->pdo->prepare("SELECT header, text, date FROM notes");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $newCard = new Card($row['header'], $row['text'], $row['date']);
            $this->CardList[] = $newCard;
        }
    }

    public function CreateCard($newTitle, $newText)
    {
        $newCard = new Card($newTitle, $newText, date("Y-m-d H:i:s"));
        $this->insertCardIntoDatabase($newCard);

    }

    private function insertCardIntoDatabase(Card $card)
    {
        $stmt = $this->pdo->prepare("INSERT INTO notes (header, text, date) VALUES (?, ?, ?)");
        $stmt->execute([$card->header, $card->text, $card->date]);
    }

    public function deleteCard($index)
    {
        if (isset($this->CardList[$index])) {
            $card = $this->CardList[$index];
            $this->deleteCardFromDatabase($card);

            // Remove the card from the CardList array
            unset($this->CardList[$index]);
            $this->CardList = array_values($this->CardList);
        }
    }

    private function deleteCardFromDatabase(Card $card)
    {
        $stmt = $this->pdo->prepare("DELETE FROM notes WHERE header = ? AND text = ? AND date = ?");
        $stmt->execute([$card->header, $card->text, $card->date]);
    }

    public function __toString()
    {
        $str = "";
        foreach ($this->CardList as $card) {
            $str = $str . $card->header . $card->date;
        }
        return $str;
    }

}
?>
