<?php

namespace Config\common\Controllers;

class ViewController extends Controller{

    public function index()
    {
        return $this->view('index');
    }
    
    public function signUp()
    {
        return $this->view('signup');
    }

}