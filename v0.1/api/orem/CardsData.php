<?php

// living inside the data layer of the api
// responsible for providing object relational mapping in between model and the sql database
// including mainly static methods
class CardsData {

    // need the database configuration
    public static function postCard($description, $board) {
        // adding the card to the relational database using pdo connection
    }

    public static function getCard($board) {
        // giving the array of objects that related to the board number of the request
    }

    public static function updateCard($board, $id, $updatedDesc) {
        // update the selected card
    }

    
}