<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Facades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function logout(){
        auth::logout();
        return redirect()->route('login');
    }
} 

