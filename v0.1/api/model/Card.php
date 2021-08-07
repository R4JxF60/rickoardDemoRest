<?php

class Card {
    private $id;
    private $description;
    private $board;

    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getBoard() {
        return $this->board;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescription() {
        $this->description = $description;
    }

    public function setBoard($board) {
        $this->board = $board;
    }

}