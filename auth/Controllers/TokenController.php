<?php

namespace Auth\Controllers;

use Auth\models\User;
use DateTime;
use Config\common\Controllers\Controller;

class TokenController extends Controller{

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createToken(){
        // Create token header & playload as a JSON string
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        $payload = json_encode([
            'user_id' => $this->user->id,
            'username' => $this->user->username
        ]);
        
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
        
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

}