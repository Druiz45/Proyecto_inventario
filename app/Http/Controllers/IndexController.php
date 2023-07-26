<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class IndexController{

    public function index(){
        // return new Response('public');
        return view('public');
    }

    public function login(){
        // return new Response('public');
        return view('viewsModels/modelLogin');
    }

}