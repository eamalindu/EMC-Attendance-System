<?php
function sendSMS($recipient, $message, $sender = "TextLKDemo") {
    $url = "https://app.text.lk/api/v3/sms/send";
    $apiKey = "1402|nVsrWd1JOKkI4r8m7oagejzZ2wbQ5cHsvQAwC1Wxf479e2a8"; // Replace with your real key

    $data = [
        "recipient" => $recipient,
        "sender_id" => $sender,
        "type"      => "plain",
        "message"   => $message
    ];

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json",
        "Accept: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return "Curl error: " . curl_error($ch);
    }

    curl_close($ch);

    return $response;
}

// Example usage
echo sendSMS("94774877845", "We are happy to inform you that your child attended today’s IT class.\n- ESOFT Nittambuwa");
