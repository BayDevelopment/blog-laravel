<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use Illuminate\Support\Facades\Auth;
class UserDashboardController extends Controller
{
    public function index()
    {
        $postCount = PostModel::where('user_id', Auth::id())->count();

        return view('dashboard.user', [
            'title'     => 'Dashboard User | Belajar Laravel',
            'navlink'   => 'Dashboard User',
            'postCount' => $postCount,
        ]);
    }
}
