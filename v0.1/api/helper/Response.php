<?php
class Response {

    private $status;
    private $statusCode;
    private $data;
    private $message = [];
    private $responseJSON = [];

    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setData($data) {
        $this->date = $data;
    }

    public function setMessage($message) {
        array_push($this->message, $message);
    }

    public function sendResponse() {
        header('Content-type:application/json;charset=utf-8');
        http_response_code($this->statusCode);
        $this->responseJSON['status'] = $this->status;
        $this->responseJSON['statusCode'] = $this->statusCode;
        $this->responseJSON['data'] = $this->data;
        $this->responseJSON['messgae'] = $this->message;
        echo json_encode($this->responseJSON);
    }


}