<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Welcome | Belajar Laravel',
            'navlink' => 'Beranda',
        ];
        return view('welcome',$data);
    }
}
