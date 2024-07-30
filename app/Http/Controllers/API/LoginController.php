<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('auth.basic.once');
    }
    public function login()
    {
    $Accesstoken =Auth::user()->createToken('Access Token')->accessToken;
    return Response(['User'=> new UserResource(Auth::user()),'Access Token '=>$Accesstoken]);
    }
}
