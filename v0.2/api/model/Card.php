<?php

class Card {

    private $cardId;
    private $description;
    private $boardNum;

    public function __construct($cardId, $description, $boardNum) {
        $this->setCardId($cardId);
        $this->setDescription($description);
        $this->setBoardNum($boardNum);
    }

    public function setCardId($cardId) {
        /*if(($cardId !== null && !is_numeric($cardId)) || $cardId <= 0 || $this->cardId !== null)
            throw new Exception('Card id issue');*/
        $this->cardId = $cardId;
    }

    public function setDescription($description) {
        if(strlen($description) > 255 || $description === null)
            throw new Exception('Description lenght issue');
        $this->description = $description;
    }

    public function setBoardNum($boardNum) {
        if($boardNum !== 'T' && $boardNum !== 'D' && $boardNum !== 'F')
            throw new Exception('Not a valid board');
        $this->boardNum = $boardNum;
    }

    public function getCardId() {
        return $this->cardId;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getBoardNum() {
        return $this->boardNum;
    }
}