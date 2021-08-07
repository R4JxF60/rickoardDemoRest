<?php

require_once('../orm/CardORM.php');
require_once('../model/Card.php');
require_once('../helper/Response.php');

class CardsController {
    // contains static functions
    public static function mainController(){
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            // for reading
            
            // controller/CardsController
            if(!isset($_GET['cardId']) && !isset($_GET['boardNum']))
                self::getCards();
            
            // controller/CardsController?cardId=
            else if(isset($_GET['cardId']) && is_numeric($_GET['cardId']))
                self::getCard($_GET['cardId']);
            
            // controller/CardsController?boardNum=
            else if(isset($_GET['boardNum']) && is_string($_GET['boardNum']))
                self::getCards_Board($_GET['boardNum']);

        // controller/CardController?cards
        }else if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // for creating
            if(isset($_GET['cards'])) 
                self::createCard(file_get_contents('php://input'));

        }else if($_SERVER['REQUEST_METHOD'] === 'PATCH') {
            // for updating

        }else if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // for deleting
        }
    }

    private static function getCards() {
        try {
            $cards = CardORM::fetchCards();
            $response = new Response();
            $response->setStatus('success');
            $response->setStatusCode(200);
            $data = [];
            foreach($cards as $object)
                array_push($data, ['cardId' => $object->getCardId(), 'description' => $object->getDescription(), 'boardNum' => $object->getBoardNum()]);
            $response->setData($data);
            $response->setMessage(count($cards).' results found');
            $response->sendResponse();
        }catch(Exception $e) {
            self::handleException();
        }
    }

    private static function getCard($cardId){
        try {
            $card = CardORM::fetchCard($cardId);
            $response = new Response();
            if(!is_null($card)) {
                $response->setStatus('success');
                $response->setStatusCode(200);
                $response->setData(['cardId' => $card->getCardId(), 'description' => $card->getDescription(), 'boardNum' => $card->getBoardNum()]);
                $response->setMessage(is_null($card).'card found');
                $response->sendResponse();
                return;
            }
            $response->setStatus('success');
            $response->setStatusCode(200);
            $response->setData($card);
            $response->setMessage('Card not found');
            $response->sendResponse();
        }catch (Exception $e) {
            self::handleException($e);
        }
    }

    private static function getCards_Board($boardNum) {
        try {
            $cards = CardORM::fetchCards_Board($boardNum);
            $response = new Response();
            $response->setStatus('success');
            $response->setStatusCode(200);
            $data = [];
            foreach($cards as $object)
                array_push($data, ['cardId' => $object->getCardId(), 'description' => $object->getDescription(), 'boardNum' => $object->getBoardNum()]);
            $response->setData($data);
            $response->setMessage(count($cards).' results found');
            $response->sendResponse();
        }catch(Exception $e) {
            self::handleException();
        }
    }

    private static function createCard($POSTData) {
        try {
            $response = new Response();
            $jsonData = json_decode($POSTData);
            if(!$jsonData) {
                $response->setStatus('fail');
                $response->setStatusCode(400);
                $response->setMessage('invalid json body');
                $response->sendResponse();
                return;
            }
            
            if(!isset($jsonData->description) || !isset($jsonData->boardNum)){
                $response->setStatus('fail');
                $response->setStatusCode(400);
                $response->setMessage('incomplete json body');
                $response->sendResponse();
                return;
            }

            $card = CardORM::storeCard(new Card(null, $jsonData->description, $jsonData->boardNum));
            $response->setStatus('success');
            $response->setStatusCode(201);
            $data = [];
            foreach($card as $object)
                array_push($data, ['cardId' => $object->getCardId(), 'description' => $object->getDescription(), 'boardNum' => $object->getBoardNum()]);
            $response->setData($data);
            $response->setMessage('successfully create the card');
            $response->sendResponse();
        }catch(Exception $e) {
            self::handleException($e); 
        }
    }

    private static function handleException($e) {
        $response = new Response();
        $response->setStatus('fail');
        $response->setStatusCode(500);
        $response->setMessage($e->getMessage());
        $response->sendResponse();
    }
}

CardsController::mainController();