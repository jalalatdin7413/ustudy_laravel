<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index() 
    {
        return 'Bul userler kestesi';
    }

    public function show($user) 
    {
        return 'Saylangan user: ' . $user;
    }

    public function create() 
    {
        return view('users.create');
    }
}
