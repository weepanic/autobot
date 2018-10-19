<?php
//ทาการ include ไฟล์ LINEBot SDK เข้ามา
require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

//Channel token กับ Channel secret ที่ได้มาจาก LINE API 
$channel_token = 'ei3rF079hSeJ7YOv0izkRGxVzmVqNbIMrHvHmpK9zjcPSkISDK69Z9W228PP7jz0lIIJsUgdb6cptqZws2pczzE4RDYSVF3GzKzZPkgr/ba1XTSR31sPQm8X17AFu8vzPz5GHzfobDF6SSUOUgQFkAdB04t89/1O/w1cDnyilFU';
$channel_secret = '74489c664a7396cc79868a96fe7498de';

// Get message from Line API $content = file_get_contents('php://
$content = file_get_contents('php://input');

//get ค่าที่ LINE Server ส่งมาให้แล้วแปลงจาก JSON ไปเป็น Array
$events = json_decode($content, true);

if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) { 
        // Line API send a lot of event type, we interested in message only.
        if ($event['type'] == 'message') {
            switch($event['message']['type']) {
                case 'text':
            
                // Get replyToken
                $replyToken = $event['replyToken'];

                // Reply message
                $respMessage = 'Hello, your message is '. $event['message']['text'];
                $respMessage = 'Hello, your message is '. $event['message']['text']; 
                $httpClient = new CurlHTTPClient($channel_token); 
                $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret)); 
                $textMessageBuilder = new TextMessageBuilder($respMessage); 
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                break;
            } 
        } 
    } 
}

?>
