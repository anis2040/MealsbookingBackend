<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

class RegisterController extends Controller
{
    private $client;
    use IssueTokenTrait;


    public function __construct()
    {
        $this->client = Client::find(1);
    }

    public function register (Request $request) {

        $this->validate($request,[
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
            'password' => bcrypt($request['password'])
        ]);

        return $this->issueToken($request, 'password');
    }
}
