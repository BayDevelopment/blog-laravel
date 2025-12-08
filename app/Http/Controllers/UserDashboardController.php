<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(){
        $data =[
            'title' => 'Dashboard User | Belajar Laravel',
            'navlink' => 'Dashboard User',
        ];
        return view('dashboard.user',$data);
    }
}
