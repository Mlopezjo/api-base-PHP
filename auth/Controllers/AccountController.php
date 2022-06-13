<?php

namespace Auth\Controllers;

use DateTime;
use Auth\models\User;
use Config\common\Validation\Validator;
use Config\common\Controllers\Controller;

class AccountController extends Controller
{

    public function register()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required'],
            'password_confirmation' => ['required'],
        ]);

        $user = (new User($this->getDB()))->getByUsername($_POST['username']);
        if ($user) {
            $response = [
                'message' => 'User already exists !',
            ];
        } else {
            if ($_POST['password'] === $_POST['password_confirmation']) {
                $options = [
                    'cost' => 12,
                ];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
                $timestamp = new DateTime('NOW');
                $data = [
                    'username' => $_POST['username'],
                    'password' => $password,
                    'created_date' => $timestamp->format('Y-m-d H:i:s')
                ];
                (new User($this->getDB()))->c($data);
                $newuser = (new User($this->getDB()))->getByUsername($data['username']);
                $response = [
                    'user' => $newuser
                ];
            }
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function login()
    {
        $validator = new Validator($_POST);

        $errors = $validator->validate([
            'username' => ['required', 'mail'],
            'password' => ['required']
        ]);

        if ($errors) {
            echo json_encode($errors, JSON_PRETTY_PRINT);
        }

        $user = (new User($this->getDB()))->getByUsername($_POST['username']);
        if ($user) {
            if (password_verify($_POST['password'], $user->password)) {

                $token = new TokenController($user);

                //$jwt = $token->createToken($user);

                $response = [
                    'user_id' => $user->id,
                    'token' => $token->createToken()
                ];
            } else {
                $response = [
                    'message' => 'Bad Credentials 2!',
                ];
            }
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    // public function checkMail(){}

    // public function changePassword(){}

    private function ramdomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lengthMax = strlen($characters);
        $ramdomString = '';
        for ($i = 0; $i < $length; $i++) {
            $ramdomString .= $characters[rand(0, $lengthMax - 1)];
        }
        return $ramdomString;
    }
}
