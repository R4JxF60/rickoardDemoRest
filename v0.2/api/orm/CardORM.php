<?php

require_once('../../config/Database.php');
require_once('../model/Card.php');

class CardORM {

    private static $table = 'cards_tbl';

    public static function fetchCards() {
        $db = Database::getDBConnection();
        $sql = 'SELECT * FROM '.self::$table;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $cards = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($cards, new Card($row['cardId'], $row['description'], $row['boardNum']));
        return $cards;
    }

    public static function fetchCard($cardId) {
        $db = Database::getDBConnection();
        $sql = 'SELECT * FROM '.self::$table.' WHERE cardId=:cardId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':cardId', $cardId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$stmt->rowCount())
            return null;
        return new Card($row['cardId'], $row['description'], $row['boardNum']);
    }

    public static function fetchCards_Board($boardNum) {
        $db = Database::getDBConnection();
        $sql = 'SELECT * FROM '.self::$table.' WHERE boardNum=:boardNum';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':boardNum', $boardNum, PDO::PARAM_STR);
        $stmt->execute();
        $cards = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($cards, new Card($row['cardId'], $row['description'], $row['boardNum']));
        return $cards;
    }

    public static function storeCard($card) {
        $db = Database::getDBConnection();
        $sql = 'INSERT INTO '.self::$table.' (cardId, description, boardNum) VALUES (:cardId, :description, :boardNum)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':cardId', $card->getCardId());
        $stmt->bindValue(':description', $card->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':boardNum', $card->getBoardNum(), PDO::PARAM_STR);
        $stmt->execute(); 
        return self::fetchCards_Board($card->getBoardNum());
    }
}