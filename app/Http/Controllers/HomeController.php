<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{





    /**-------------------認証機能------------------------ */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }




    
  /**-------------------ホームページ遷移------------------------ */
    public function index()
    {
        return view('home');
    }
}
