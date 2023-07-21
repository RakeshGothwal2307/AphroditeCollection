<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MemberController extends Controller
{
    public function index(){
        return 0;
    }

    public function login(){
        $credentials=['username'=>'ayush@gmail.com','password'=>'ayush1216'];
        Auth::guard('member')->attempt($credentials);
            if(auth()){
                return 1;
            }
            else{
                return 0;
            }
        }
}
