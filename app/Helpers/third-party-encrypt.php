<?php

if (!function_exists('third_party_crypt')) {
    function third_party_crypt(string $string, $action = 'e', $code = 'stander'): bool|string
    {
        switch ($code) {
            case "stander":
                $secret_key = 'thisIsmySecretKey:)';
                $secret_iv = 'thisIsmySecretIv:)';
                break;
            case 'hc_login':
                $secret_key = 'cre@t€L0g!nK€y123)';
                $secret_iv = 'cre@t€L0g!n!V123)';
                break;
            case 'sp_login':
                $secret_key = 'Cr€d@nti@l:1ogin:key)';
                $secret_iv = 'Cr€d@nti@l:1ogin:Iv)';
                break;
            case "hco_url":
                $secret_key = '!URL:ch@nge:123)key';
                $secret_iv = '!URL:ch@nge:123)iv';
                break;
            case "chat":
                $secret_key = '!URL:ch@t:123)key';
                $secret_iv = '!URL:ch@t:123)iv';
                break;
            case "transaction":
                $secret_key = '!m0n€y:ch@nge:123)key';
                $secret_iv = '!m0n€y:ch@nge:123)iv';
                break;
            case "video":
                $secret_key = '!V!d€0:123)key';
                $secret_iv = '!V!d€0:123)iv';
                break;
            case 'article':
                $secret_key = 'cre@t€/@rt!cl€/K€y123)';
                $secret_iv = 'cre@t€/@rt!cl€/!V123)';
            case "course":
                $secret_key = '!C0ur$€:123)key';
                $secret_iv = '!C0ur$€:123)iv';
                break;
            default:
                $secret_key = 'thisIsmySecretKey:)';
                $secret_iv = 'thisIsmySecretIv:)';
        }

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } else if ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}
