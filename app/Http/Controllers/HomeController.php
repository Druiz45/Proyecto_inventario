<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class HomeController{

    public function index(){
        // return new Response('home');
        return view('home');
    }

    public function user(){
        return view('user');
    }

}