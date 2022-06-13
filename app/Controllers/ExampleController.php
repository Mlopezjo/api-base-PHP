<?php

namespace App\Controllers;

use DateTime;
use App\Models\Example;
use Config\common\Validation\Validator;
use Config\common\Controllers\Controller;

class ExampleController extends Controller{

    // Your Function here
    public function example()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required'],
            'password_confirmation' => ['required'],
        ]);

        $example = (new Example($this->getDB()))->findById($_POST['id']);
        if ($example) {
            $response = [
                'message' => 'example already exists !!',
            ];
        } else {
            $timestamp = new DateTime('NOW');
            $data = [
                'exampleName' => $_POST['exampleName'],
                'created_date' => $timestamp->format('Y-m-d H:i:s')
            ];
            (new Example($this->getDB()))->c($data);
            $newexample = (new Example($this->getDB()))->findByexampleName($data['exampleName']);
            $response = [
                'example' => $newexample
            ];
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

}