<?php
function getUserIP() {
    $ip = '';

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP from shared internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP passed from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        // Sometimes it's a list of IPs, take the first one
        $ip = explode(',', $ip)[0];
    } else {
        // Direct IP from remote address
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return trim($ip);
}
