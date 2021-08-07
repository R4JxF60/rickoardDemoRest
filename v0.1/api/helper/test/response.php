<?php

require_once('../Response.php');

$response = new Response();
$response->setStatusCode(404);
$response->setStatus('success');
$response->setMessage('first message!');
$response->setMessage('second message!');
$response->sendResponse();